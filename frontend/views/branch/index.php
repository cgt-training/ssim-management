<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Create Branch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'company_name',// Here company_name is attribute name used for sorting purpose
                'value'=>'companyFk.company_name' // Here companyFk is the relation in Branch Model and company_name is column name in company table
            ],
            'branch_name',
            ['attribute'=>'branch_created',
                'value'=>'branch_created',
               'filter' => \yii\jui\DatePicker::widget([
                'model'=>$searchModel,
                'attribute'=>'branch_created',
                'dateFormat' => 'yyyy-MM-dd',
            ]),
                'format' => 'html',],
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
