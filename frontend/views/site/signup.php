<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
<h1><?= Html::encode($this->title) ?></h1>

    

    <p>Please fill out the following fields to signup:</p>

    
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <div class="row">
        <div class="col-sm-6 col-xs-12">

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'firstname') ?>

                <?= $form->field($model, 'lastname') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

            
        </div>

        <!-- <div class="col-sm-6 col-xs-12">

            <h5>Company Permission</h5>
            <?= $form->field($model, 'create_company')->checkbox(array('label'=>'Permit To create Company','value'=>'create_company')); ?>

            <?= $form->field($model, 'update_company')->checkbox(array('label'=>'Permit To update Company','value'=>'update_company')); ?>

            <?= $form->field($model, 'delete_company')->checkbox(array('label'=>'Permit To delete Company','value'=>'delete_company')); ?>

            <h5>Branch Permission</h5>

            <?= $form->field($model, 'create_branch')->checkbox(array('label'=>'Permit To create Company','value'=>'create_branch')); ?>

            <?= $form->field($model, 'update_branch')->checkbox(array('label'=>'Permit To update Company','value'=>'update_branch')); ?>

            <?= $form->field($model, 'delete_branch')->checkbox(array('label'=>'Permit To delete Company','value'=>'delete_branch')); ?>

            <h5>Department Permission</h5>
            <?= $form->field($model, 'create_department')->checkbox(array('label'=>'Permit To create Company','value'=>'create_department')); ?>

            <?= $form->field($model, 'update_department')->checkbox(array('label'=>'Permit To update Company','value'=>'update_department')); ?>

            <?= $form->field($model, 'delete_department')->checkbox(array('label'=>'Permit To delete Company','value'=>'delete_department')); ?>

        </div> -->
        </div>
        <div class="form-group text-center">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-lg', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    
</div>
