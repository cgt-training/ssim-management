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

class DepartmentController extends \yii\web\Controller
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
     * Lists all Department Model.
     */
    public function actionIndex()
    {
        $searchModel = new DepartmentSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
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

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate($id)
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

}