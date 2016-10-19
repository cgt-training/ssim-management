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

        
        </div>
        <div class="form-group text-center">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary btn-lg', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    
</div>
