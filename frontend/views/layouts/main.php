<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\web\YiiAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://use.fontawesome.com/587fe13c10.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <nav class="navbar navbar-default no-margin-bottom">
        <div class="container padding-15 ">
            <div class="logo navbar-left row">
                <div class="float-left col-xs-3">
                <?php $img = Url::to('@web/frontend/web/images/28-sep/logo.png');     
                echo Html::img($img,['alt' => 'My logo','class'=>"img-responsive"]);?>
                    <!-- <img src="../img/28-sep/logo.png" class="img-responsive" style="margin: auto"> -->
                </div>
                <div class="float-left text-white col-xs-9">
                    <h2 style="margin-top:0px;">Shri Shukhmani Institude Of Management</h2>
                    <h4>(Approved By A.I.C.T, Govt. of India)</h4>
                </div>
                
                
            </div>
            <form class="navbar-form navbar-right">
            <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
          </form>
        </div>
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse nav-bg" id="bs-example-navbar-collapse-1">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#" class="tabs__link">Home <span class="sr-only">(current)</span></a></li>
            <li><a href="#" >About</a></li>
            <li><a href="#" >Courses</a></li>
            <li><a href="#" >Admission</a></li>
            <li><a href="#" >Development</a></li>
            <li><a href="#" >Faculty</a></li>
            <li><a href="#" >Procedure</a></li>
            <li><a href="#" >Contact Us</a></li>
          </ul> -->
          <?php
          $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Company', 'url' => ['/company'],'active'=>Yii::$app->controller->id=='company'&&Yii::$app->controller->action->id!='list',],
        ['label' => 'Company-List', 'url' => ['/company/list'],'active'=>Yii::$app->controller->action->id=='list',],
        ['label' => 'Branch', 'url' => ['/branch'],'active'=>Yii::$app->controller->id=='branch',],
        ['label' => 'Department', 'url' => ['/department'],'active'=>Yii::$app->controller->id=='department',],
        ['label' => 'Customer', 'url' => ['/customer'],'active'=>Yii::$app->controller->id=='customer',],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'LogOut(' . Yii::$app->user->identity->username .')', 'url' => ['/site/logout']];
    }
    echo Menu::widget([
        'options' => ['class' => 'nav navbar-nav'],
        'items' => $menuItems,
        'activeCssClass'=>'active',
    ]);
          ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
</header>

<div class="container">
     <div class="jumbotron banner no-padding-lr">
        <div class="row no-margin-left text-center">
            <div class="col-lg-6 col-xs-10 red-bg text-white">
                <h2>ADMISSION OPEN - PGDM</h2>
                <h5 style="background: rgba(160, 7, 7, 0.68);padding: 5px;">POST GRADUATION DIPLOMA IN MANAGEMENT</h5>
            <p>Two years full time programme</p>
            <h5>Specialized in Finance, Retail Marketing and Retial Marketing</h5>
          
            </div>
        </div>
      
    </div>

    <div class="row">

        <div class="col-md-3 col-sm-3 col-xs-6">
           <?php $img = Url::to('@web/frontend/web/images/28-sep/image1.png');     
                echo Html::img($img,['alt' => 'My logo','class'=>"img-responsive"]);?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
            <?php $img = Url::to('@web/frontend/web/images/28-sep/image2.png');     
                echo Html::img($img,['alt' => 'My logo','class'=>"img-responsive"]);?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
            <?php $img = Url::to('@web/frontend/web/images/28-sep/image1.png');     
                echo Html::img($img,['alt' => 'My logo','class'=>"img-responsive"]);?>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
            <?php $img = Url::to('@web/frontend/web/images/28-sep/image2.png');     
                echo Html::img($img,['alt' => 'My logo','class'=>"img-responsive"]);?>
        </div>

    </div>

    <div class="row margin-top-15 wheat-bg padding-15" id="main-content">
     <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer>
    <nav class="navbar navbar-inverse no-margin-bottom">
  <div class="container text-center text-white">
    2014 Right Reserved
    <div class="navbar-right text-right" style="float:right">
        <ul class="social-icons">
        <li><small style="font-size: 12px">Follow Us On</small></li>
            <li><i class="fa fa-twitter-square"></i></li>
            <li><i class="fa fa-facebook-square"></i></li>
            <li><i class="fa fa-google-plus-square"></i></li>
        </ul>
        <h5>Developed By CG-Technosoft</h5>
    </div>
  </div>
</nav>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
