<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\View;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d h:i:sa");
?>

<div class="company-form">
<div class="alert alert-success" role="alert" style="display: none">
    <p>Company Created Successfully</p>
</div>
    <?php  $form = ActiveForm::begin(['id'=>'dynamic-form']); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <!-- readonly field.... Shows date created when the company is updated(Not shown when company is created) -->
    <?= $model->isNewRecord ?'':($form->field($model, 'company_created')->textInput(['readonly' =>true])) ?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive' ], ['prompt' => 'Select']) ?>

    <?php $img = Url::to(Yii::$app->urlManagerFrontend->baseUrl.'/'.$model->company_profile);   ?>
    <?= $model->isNewRecord ?'':(Html::img($img,['alt' => 'Profile','class'=>"img-responsive",'width'=>200,])) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>
    <?= $model->isNewRecord ?'
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Addresses</h4></div>
        <div class="panel-body">
             '. DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsBranch[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'branch_name',
                    'branch_status',
                ],
            ]).'

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsBranch as $i => $modelBranch): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Create Branch</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelBranch->isNewRecord) {
                                echo Html::activeHiddenInput($modelBranch, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($modelBranch, "[{$i}]branch_name")->textInput(["maxlength" => true]) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelBranch, "[{$i}]branch_status")->dropDownList([ "active" => "Active", "deactive" => "Deactive" ], ["prompt" => "Select"])?>
                            </div>
                            
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>':''?>

        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= $this->registerJsFile('@web/js/customJs/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>