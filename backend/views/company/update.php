<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = 'Update Company: ' . $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->company_name, 'url' => ['view', 'id' => $model->company_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-update">
	<?php
    if(isset($msg))
    {
        echo '<h3 class="text-center" style="color:red">'.$msg.'</h3>';
    }
?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
