<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Buy */

$this->title = 'ดูรายการโอนเงิน';
$this->params['breadcrumbs'][] = ['label' => 'รายการโอนเงิน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-view">



<!--    <p>
            <?= Html::a('ขาย', ['accept', 'id' => $model->bid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->bid], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->bid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>-->

   <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
                <li class="pull-left header"><i class="fa fa-tree"> ข้อมูลการสั่งซื้อ</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">


   
    
    <div class="row">
  <div class="col-md-4"> </div>
  <div class="col-md-4">
      
                    
 <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
<!--             Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-tree"> <?=$model->products->pname ?></i></li>
            </ul>
           <!--เนื้อหา--> 
          <div class="box-body">
              
              
                   
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <?php 
      $i=1;
      foreach ($picall->models as $key => $value)
          
{     ?>
                 
    <li data-target="#carousel-example-generic" data-slide-to="<?=$i?>"></li>      
      <?php $i++; } ?> 
   
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
      <div class="item active">
         <?= Html::img('../../frontend/web/img'.'/'.$model->products->pic); ?>
<!--          <img src="<?= \yii\helpers\Url::to('@frontend/web/img/').$model->products->pic ?>" alt="">-->
    </div>
      <?php foreach ($picall->models as $key => $value)
{
               
           ?>
               
                 <div class="item">
                     <?= Html::img('../../frontend/web/img'.'/'.$value['picname']); ?>
    
    </div>
      <?php } ?>              
            
 
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">ย้อนกลับ</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">ถัดไป</span>
  </a>
</div>

      </div>
          </div>
</div>    
  </div>
  <div class="col-md-4"> </div>
</div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bid',
            //'products.pname',
             [  
        'label' => 'สินค้า',
        'value' => 'รหัส '.$model->products->pid.' '.$model->products->pname ,
    ],
             'products.typebuy.tbname',
            [  
        'label' => 'จำนวนซื้อ',
        'value' => $model->bqty.' '.$model->products->unit ,
    ],
             [  
        'label' => 'ราคาซื้อ',
        'value' => $model->pricein.' บาท',
    ],
            //'pricein', 
           // 'bqty', 
            'datetimeabuy',
            [
            'label' => 'หมดอายุ',
            'format' => 'raw',
            'value' => function($model){
        if($model->datecheck===0){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('ต่ออายุ', ['buy/datenew', 'id' => $model->bid], [
            'class' => 'btn btn-success btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องการต่ออายุการสั่งซื้อใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            } else{return $model->datecheck; }
            }
        ],
        
         //'products.typeproduct.tpname',
         //'products.unitU.uname',
            //'status',
                 
                 [  
        'label' => 'ชื่อลูกค้า',
        'value' => $model->user->name.' '.$model->user->surname,
    ],
                 //'user.name',
            'deliv.address',
            'deliv.districts.DISTRICT_NAME',
              'deliv.districts.amphure.AMPHUR_NAME',
            'deliv.districts.amphure.province.PROVINCE_NAME',
            'deliv.zipcode',
            'deliv.tel',
           
            
                
        ],
    ]) ?>
</div>
</div>
     <!--    ข้อมูลผู้ขาย-->
    <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
                <li class="pull-left header"><i class="fa fa-user"> ข้อมูลผู้ขาย</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'products.user.id',
            [  
        'label' => 'ชื่อ-นามสกุล',
        'value' => $model->products->user->name.' '.$model->products->user->surname,
    ],
            
        
         //'products.typeproduct.tpname',
         //'products.unitU.uname',
            //'status',
                 
                 //'user.name',
            'products.user.address',
            'products.user.district.DISTRICT_NAME',
              'products.user.district.amphure.AMPHUR_NAME',
            'products.user.district.amphure.province.PROVINCE_NAME',
            'products.user.zipcode',
             'products.user.email',
            'products.user.tel',      
        ],
    ]) ?>
</div>
</div>
<!--    ข้อมูลผู้ซื้อ-->
    <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
                <li class="pull-left header"><i class="fa fa-user"> ข้อมูลผู้ซื้อ</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.id',
            [  
        'label' => 'ชื่อ-นามสกุล',
        'value' => $model->user->name.' '.$model->user->surname,
    ],
            
        
         //'products.typeproduct.tpname',
         //'products.unitU.uname',
            //'status',
                 
                 //'user.name',
            'user.address',
            'user.district.DISTRICT_NAME',
              'user.district.amphure.AMPHUR_NAME',
            'user.district.amphure.province.PROVINCE_NAME',
            'user.zipcode',
             'user.email',
            'user.tel',      
        ],
    ]) ?>
</div>
</div>

</div>
