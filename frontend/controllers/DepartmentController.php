<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Department;
use frontend\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Company;
use frontend\models\Branch;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\helpers\Json;

class DepartmentController extends \yii\web\Controller
{
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
                    ],//guest user can only view department
                    [
                        'actions' => ['view','index','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],// authenticated user can only create update delete department according to authmanager
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
     * Lists all Department Model.
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=['pageSize'=>5];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create_department'))//Authenticate whether user have right to create department
        {
            $model = new Department();
            $company = Company::find()->orderBy('company_name')->all(); 
            $branch = Branch::find()->orderBy('branch_name')->all(); 
            date_default_timezone_set('Asia/Kolkata');
            $current_date = date("Y-m-d h:i:sa");
            $model->department_created = $current_date;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->department_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,'company'=>$company,'branch'=>$branch,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
        
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update_department'))//Authenticate whether user have right to update department
        {
            $model = $this->findModel($id);
            $company = Company::find()->orderBy('company_name')->all(); 
            $branch = Branch::find()->orderBy('branch_name')->all(); 
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->department_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,'company'=>$company,'branch'=>$branch,
                ]);
            }
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }

    /**
     * Displays a single Department model.
     */
     public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     */
    protected function findModel($id)
    {
        if (($model = Department::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     /**
     * Deletes an existing Department model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('delete_department'))//Authenticate whether user have right to delete department
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else{
            throw new ForbiddenHttpException('You are not permitted to do this action');
        }
    }

    public function actionBranch() {
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $company_id = $parents[0];
            $out = Branch::braclist($company_id); 
            $result=[];
            foreach ($out as $each) {
                $result[]= ['id'=>$each->branch_id,'name'=>$each->branch_name];
            }
            echo Json::encode(['output'=>$result, 'selected'=>'']);
            return;
        }
    }
    echo Json::encode(['output'=>'No branch for the selected', 'selected'=>'']);
}


}
