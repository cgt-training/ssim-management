<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d h:i:sa");
?>

<div class="company-form">

    <?php  $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <!-- readonly field.... Shows date created when the company is updated(Not shown when company is created) -->
    <?= $model->isNewRecord ?'':($form->field($model, 'company_created')->textInput(['readonly' =>true])) ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive' ], ['prompt' => 'Select']) ?>

    <?php $img = Url::to('@web/frontend/web/'.$model->company_profile);   ?>
    <?= $model->isNewRecord ?'':(Html::img($img,['alt' => 'Profile','class'=>"img-responsive",'width'=>200,])) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>

        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
