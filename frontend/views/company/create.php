<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Create Company';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">
<?php
    if(isset($msg))
    {
        echo '<h3 class="text-center" style="color:red">'.$msg.'</h3>';
    }
?>
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
