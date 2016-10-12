<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->user->isGuest?'':Html::a('Update', ['update', 'id' => $model->company_id], ['class' => 'btn btn-primary']) ?>
        <?= Yii::$app->user->isGuest?'':Html::a('Delete', ['delete', 'id' => $model->company_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = Url::to('@web/frontend/web/'.$model->company_profile);     
                echo Html::img($img,['alt' => 'Profile','class'=>"img-responsive",'width'=>200,'style'=>['margin'=>'auto']]);?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'company_id',
            'company_name',
            'company_email:email',
            'company_address',
            'company_created',
            'company_status',
        ],
    ]) ?>

</div>
