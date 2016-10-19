<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Model;
use app\base\Controller;
use app\models\AuthItem;
use app\models\AuthItemChild;
use app\models\AuthItemSearch;
use yii\data\ActiveDataProvider;

class RolesController extends \yii\web\Controller
{
    public function actionIndex()
    {    
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data =[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];

        return $this->render('index',$data);
    }       

   public function actionCreate()
    {
        $modelAuthItem = new AuthItem;
        $modelAuthItemChild = [new AuthItemChild];

        if ($modelAuthItem->load(Yii::$app->request->post())) {

            $modelAuthItemChild = Model::createMultiple(AuthItemChild::classname());
            $modelAuthItemChild = Model::loadMultiple($modelAuthItemChild, Yii::$app->request->post('AuthItemChild'));

            // validate person and po item models
            $modelAuthItem->type = 1;
            $valid = $modelAuthItem->validate();
            // $valid = Model::validateMultiple($modelAuthItemChild) && $valid;

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelAuthItem->save(false)) {
                        foreach ($modelAuthItemChild as $index => $each) {

                            if ($flag === false) {
                                break;
                            }

                            $modelAuthPermission = new AuthItem();
                            $modelAuthPermission->name = $each->permission_name;
                            $modelAuthPermission->description = $each->permission_desc;
                            $modelAuthPermission->type = 2;
                            $modelAuthPermission->save();

                            $each->parent = $modelAuthItem->name;
                            $each->child = $each->permission_name;

                            if (!($flag = $each->save(false))) {
                                break;
                            }

                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelAuthItem' => $modelAuthItem,
            'modelAuthItemChild' => (empty($modelAuthItemChild)) ? [new AuthItemChild] : $modelAuthItemChild,
        ]);
    }
}
