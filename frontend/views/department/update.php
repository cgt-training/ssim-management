<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Update Department: ' . $model->department_id;
$this->params['breadcrumbs'][] = ['label' => 'Departments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->department_id, 'url' => ['view', 'id' => $model->department_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'company'=>$company,'branch'=>$branch,
    ]) ?>

</div>
