<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
// use dosamigos\datepicker\DatePicker;
use yii\jui\DatePicker;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php  
        Modal::begin([
        'header' => '<h2>Company</h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
        //'toggleButton' => ['label' => 'click me'],
        ]);

        echo '<div id="modalContent">
                    
                  </div>';

        Modal::end();
    ?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>        
        <?= Yii::$app->user->isGuest?'':Html::button('Create Company', ['value'=>Url::toRoute('create'), 'class' => 'btn btn-success modalButton', 'id'=>'modalButton' ]) ?>
    </p>

<?php Pjax::begin(['id'=>'company-pjax']); 

?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($searchModel){   
            if($searchModel->company_status == 'active') {
                return ['class' => 'success'];
            }
            else{
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'company_name',
            'company_email:email',
            'company_address',
            [
            'attribute' => 'img',
            'format' => 'html',
            'label' => 'Company Profile',
            'value' => function ($dataProvider) {
                return Html::img('@web/frontend/web/'.$dataProvider['company_profile'],
                    ['width' => '60px']);
            },
            ],
            ['attribute'=>'company_created',
                'value'=>'company_created',
               'filter' => DatePicker::widget([
                'model'=>$searchModel,
                'attribute'=>'company_created',
                'dateFormat' => 'yyyy-MM-dd',
            ]),
                'format' => 'html',],
            // 'company_status',

            ['class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                    'update'=> function () {
                        return Yii::$app->user->isGuest? false : true;
                     },
                    'delete' => function () {
                        return Yii::$app->user->isGuest? false : true;
                     },
                ],
             'buttons' => [
                    'delete' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                    },
                ],
            ],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
<?= $this->registerJsFile('@web/frontend/web/js/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>