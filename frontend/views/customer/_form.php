<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>
    <?php  $locationList = ArrayHelper::map($location, 'zip_code', 'zip_code');  ?>
    <?= $form->field($model, 'zip_code')->widget(Select2::classname(), [
            'data' => $locationList,
            'id'=>'zip_code',
            'options' => ['placeholder' => 'Select a Zipcode ...','onchange'=>'fill_data()'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>


    <?= $form->field($model, 'city')->textInput(['maxlength' => true,'id'=>'city','readonly' =>true]) ?>
    <?= $form->field($model, 'provience')->textInput(['maxlength' => true,'id'=>'provience','readonly' =>true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
