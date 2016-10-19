<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($searchModel){   
            if($searchModel->status == 10) {
                return ['class' => 'success'];
            }
            else{
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'email:email',
            'role',
            // [
            //     'attribute' => 'image',
            //     'value' => function($dataProvider){
            //         if(!empty($dataProvider->image) && file_exists('uploads/user/'.$dataProvider->image)){
            //                 return Html::img('@user_profile_photo_path/'.$dataProvider->image,
            //                 ['class' => 'center-block', 'height' => '100px']);
            //             }
            //             else{
            //                 return '';
            //             }
            //     },
            //     'format' => 'html'
            // ],
            'created_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
