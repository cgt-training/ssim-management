<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branch-form">

    <?php  $form = ActiveForm::begin(); ?>

    <!-- Convert the company list data in array form to show in dropdownlist -->
    <?php  $companyList = ArrayHelper::map($company, 'company_id', 'company_name');  ?>

    <!-- List down all the company for selection -->
     <?= $form->field($model, 'company_fk_id')->widget(Select2::classname(), [
            'data' => $companyList,
            'options' => ['placeholder' => 'Select a Company ...','id'=>'company-id'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
     
    ?>

    <!-- Convert the branch list data in array form to show in dropdownlist -->
    <?php  $branchList = ArrayHelper::map($branch, 'branch_id', 'branch_name');  ?>

    <!-- List down all the branch for selection -->
      <?=   $form->field($model, 'branch_fk_id')->widget(DepDrop::classname(), [
             'options' => ['id'=>'branch-id','placeholder' => 'First select Company ...'],
             'pluginOptions'=>[
                 'depends'=>['company-id'],
                 'placeholder' => 'Select Branch...',
                 'url' => Url::to(['/department/branch']),
                 'pluginOptions' => [
                        'allowClear' => true
                    ],
             ]
         ]);
    ?>

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    <!-- readonly field.... Shows date created when the department is updated(Not shown when department is created) -->
    <?= $model->isNewRecord ?'':($form->field($model, 'department_created')->textInput(['readonly' =>true])) ?>

    <?= $form->field($model, 'department_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive' ], ['prompt' => 'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
