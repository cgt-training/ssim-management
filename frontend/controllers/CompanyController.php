<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Company;
use frontend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\data\Pagination;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
   // public $layout='initial';
    
        /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['view', 'index','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['view','index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['view','index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=['pageSize'=>5];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=['pageSize'=>5];
        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        //echo Url::to(['company/view'],true);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
        date_default_timezone_set('Asia/Kolkata');
        $current_date = date("Y-m-d h:i:sa");
        $model->company_created = $current_date;

        if(Yii::$app->user->can('create_company'))//Authenticate whether user have right to create company
        {
            if ($model->load(Yii::$app->request->post())) {
                $imageName= $model->company_name;

                $model->file = UploadedFile::getInstance($model,'file');
                if($model->file->extension=='gif'||$model->file->extension=='jpg'||$model->file->extension=='png')
                {
                    $model->file->saveAs('uploads/'.$imageName.'.'.$model->file->extension);

                    // save the path in DB.

                    $model->company_profile = 'uploads/'.$imageName.'.'.$model->file->extension;

                    
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->company_id]);
                }
                else{
                    return $this->renderAjax('create', [
                    'model' => $model,'msg'=>'Please upload image file only',
                ]);
                }

                
            }  
            else 
            {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }

    }

    

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->can('update_company'))//Authenticate whether user have right to update company
        {
            if ($model->load(Yii::$app->request->post())) 
            {
                
                $imageName= $model->company_name;

                $model->file = UploadedFile::getInstance($model,'file');
                if($model->file!='')
                {

                 if(($model->file->extension=='gif'||$model->file->extension=='jpg'||$model->file->extension=='png'))
                    {

                        $model->file->saveAs('uploads/'.$imageName.'.'.$model->file->extension);

                        // save the path in DB.

                        $model->company_profile = 'uploads/'.$imageName.'.'.$model->file->extension;
                        
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->company_id]);
                    }
                    else
                    {
                        return $this->render('update', ['model' => $model,'msg'=>'Please upload image file only',]);
                    } 
                }
                else{
                    $model->save();
                    return $this->redirect(['view', 'id' => $model->company_id]);
                }
            }
            else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('delete_company'))//Authenticate whether user have right to delete company
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
