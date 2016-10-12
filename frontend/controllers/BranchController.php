<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Branch;
use frontend\models\BranchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Company;

class BranchController extends Controller
{
	 public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

     /**
     * Lists all Branch models.
     */
    // This is the default method which is called when branch is evoke
    public function actionIndex()
    {
    	$searchModel = new BranchSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Branch model.
     */
     public function actionView($id)
    {
        $model = $this->findModel($id);
        //$company = Company:: findOne($model->company_fk_id);
        //$company = Company:: findOne($model->company_fk_id);
        //$model->company_fk_id = $company->company_name;
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new Branch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
         $model = new Branch();
         $company = Company::find()->orderBy('company_name')->all(); 
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d h:i:sa");
        $model->branch_created = $current_date;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->branch_id]);
        } else {
            return $this->render('create', [
                'model' => $model,'company'=>$company,
            ]);
        }

        
    }

    /**
     * Updates an existing Branch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $company = Company::find()->orderBy('company_name')->all(); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->branch_id]);
        } else {
            return $this->render('update', [
                'model' => $model,'company'=>$company,
            ]);
        }
    }

    /**
     * Deletes an existing Branch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Branch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     */
     protected function findModel($id)
    {
        if (($model = Branch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



}
