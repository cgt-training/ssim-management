<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Create Branch';
$this->params['breadcrumbs'][] = ['label' => 'Branches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'company'=>$company,
    ]) ?>

</div>