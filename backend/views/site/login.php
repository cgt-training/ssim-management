<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>
<body >
<div class="login-box">
  <div class="login-logo">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
    <p class="login-box-msg">
      <?= isset($msg)?'<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Sorry!</h4>'.$msg.'</div>':'Sign in to start your session'?>
    </p>

    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
      <div class="form-group has-feedback">
         <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'form-control']) ?>
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
      </div>
      <div class="form-group has-feedback">
        <?= $form->field($model, 'password')->passwordInput() ?>
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
      </div>
      <div class="row">
        <div class="col-xs-8">
          <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
          
        </div>
        <!-- /.col -->
      </div>
   <?php ActiveForm::end(); ?>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



