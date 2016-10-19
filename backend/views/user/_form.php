<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">

        <div class="form-group">
        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true],['class'=>'form-control']) ?>
        </div>

        <div class="form-group">
        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="form-group">
        <?= $form->field($model, 'status')->dropdownlist([10=>'Active',0=>'Deleted'],['prompt'=>'Select Status..']) ?>
        </div>

        <div class="form-group">
        <?= $form->field($model, 'role')->dropdownlist($dropDownOptions,['prompt'=>'Select Role..']) ?>
        </div>
    </div>    

    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


