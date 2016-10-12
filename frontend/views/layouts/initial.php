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

<?php
          $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Company', 'url' => ['/company'],'active'=>Yii::$app->controller->id=='company',],
        ['label' => 'Branch', 'url' => ['/branch'],'active'=>Yii::$app->controller->id=='branch',],
        ['label' => 'Department', 'url' => ['/department'],'active'=>Yii::$app->controller->id=='department',],
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

<?= Alert::widget() ?>

        <?= $content ?>
        
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
