<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\Company;
use frontend\models\CompanySearch;
use frontend\models\Branch;
use frontend\models\Department;
use yii\data\Pagination;

/**
 * Site controller
 */
class DashboardController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array('site/login'));
        }
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination=['pageSize'=>5];
        
        $company =  Company::find()->count();
        $branch = Branch::find()->count();
        $department = Department::find()->count();
        $user = User::find()->count();
        return $this->render('index',
            [
                'company'=>$company,
                'branch'=>$branch,
                'department'=>$department,
                'user'=>$user,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
    }
	

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(array('site/login'));
    }

}