<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;
$this->title = 'Dashboard';
?>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $company?></h3>

              <p>No. of Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?= Url::toRoute('company')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $branch?></h3>

              <p>No. of Branches</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $department?></h3>

              <p>No. of Departments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= Url::toRoute('')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $user?></h3>

              <p>User Registered</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-sm-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Companies</h3>
              </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php Pjax::begin(['id'=>'company-pjax']); ?>    
                  <?= GridView::widget([
                          'dataProvider' => $dataProvider,
                          'filterModel' => $searchModel,
                          'rowOptions' => function ($searchModel){   
                              if($searchModel->company_status == 'active') {
                                  return ['class' => 'success'];
                              }
                              else{
                                  return ['class' => 'danger'];
                              }
                          },
                          'columns' => [
                              ['class' => 'yii\grid\SerialColumn'],

                              'company_name',
                              'company_email:email',
                              [
                              'attribute' => 'img',
                              'format' => 'html',
                              'label' => 'Company Profile',
                              'value' => function ($dataProvider) {
                                  return Html::img(Yii::$app->urlManagerFrontend->baseUrl.'/'.$dataProvider['company_profile'],
                                      ['width' => '60px']);
                              },
                              ],

                              ['class' => 'yii\grid\ActionColumn',
                              'visibleButtons' => [
                                      'update'=> function () {
                                          return Yii::$app->user->isGuest? false : true;
                                       },
                                      'delete' => function () {
                                          return Yii::$app->user->isGuest? false : true;
                                       },
                                  ],
                               'buttons' => [
                                      'delete' => function ($url, $model) {
                                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,['class'=>"delete-request"]);
                                      },
                                  ],
                              ],
                              
                          ],
                      ],['class'=>'table table-bordered']); ?>
                  <?php Pjax::end(); ?>
            
              
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer clearfix">
            
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div> -->
          </div>
        </div>
      </div>
      
   