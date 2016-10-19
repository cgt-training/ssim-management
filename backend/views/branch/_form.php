<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d h:i:sa");
?>

<div class="branch-form">

    <?php  $form = ActiveForm::begin(); ?>

    <!-- Convert the company list data in array form to show in dropdownlist -->
    <?php  $companyList = ArrayHelper::map($company, 'company_id', 'company_name');  ?>

    <!-- List down all the company for selection -->
    <?= $form->field($model, 'company_fk_id')->widget(Select2::classname(), [
            'data' => $companyList,
            'language' => 'de',
            'options' => ['placeholder' => 'Select a Company ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>


    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <!-- readonly field.... Shows date created when the branch is updated(Not shown when branch is created) -->
    <?= $model->isNewRecord ?'':($form->field($model, 'branch_created')->textInput(['readonly' =>true])) ?>

    <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive' ], ['prompt' => 'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
