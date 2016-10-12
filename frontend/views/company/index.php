<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
// use dosamigos\datepicker\DatePicker;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php Pjax::end(); ?></div>
