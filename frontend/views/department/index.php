<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>        
        <?= Html::button('Create Department', ['value'=>Url::to('create'), 'class' => 'btn btn-success', 
                                                'id'=>'modalButton' ]) ?>
    </p>

    <?php  
        Modal::begin([
        'header' => '<h2>Create Department</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
        //'toggleButton' => ['label' => 'click me'],
        ]);

        echo '<div id="modalContent">
                    
                  </div>';

        Modal::end();
    ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($searchModel){   
            if($searchModel->department_status == 'active') {
                return ['class' => 'success'];
            }
            else{
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'company_name',
                'value'=>'company.company_name'
            ],//company name is shwn with the sorting on.
            [
                'attribute'=>'branch_name',
                'value'=>'branch.branch_name'
            ],//branch name is shwn with the sorting on.
            'department_name',
            ['attribute'=>'department_created',
                'value'=>'department_created',
               'filter' => \yii\jui\DatePicker::widget([
                'model'=>$searchModel,
                'attribute'=>'department_created',
                'dateFormat' => 'yyyy-MM-dd',
            ]),
                'format' => 'html',],
            'department_status',

            ['class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                    'update'=> function () {
                        return Yii::$app->user->isGuest? false : true;
                     },
                    'delete' => function () {
                        return Yii::$app->user->isGuest? false : true;
                     },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
