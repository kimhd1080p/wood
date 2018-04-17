<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Buy */

$this->title = 'ดูรายการสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'รายการสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-view">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    
    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
            <li class="pull-left header"><i class="fa fa-cart-arrow-down"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

    <p>
       
      
        <?php
//         if($model->status !=2) {echo Html::a('แก้ไข', ['update', 'id' => $model->bid], ['class' => 'btn btn-primary'], [
//            'class' => 'glyphicon glyphicon-pencil',
//            'data' => [
//                
//                'method' => 'post',
//            ],
//        ]);
//         
//         echo Html::a('ลบ', ['delete', 'id' => $model->bid], ['class' => 'btn btn-danger'], [
//            'class' => 'glyphicon glyphicon-trash',
//            'data' => [
//                'confirm' => "คุณต้องการลบรายการนี้ใช่หรือไม่ ?",
//                'method' => 'post',
//            ],
//        ]);
//         }
         
       ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bid',
            'pricein',
                'bqty',
             'products_id',
             'products.pname',
             'products.unit',
            'datetimeabuy',
            'deliv.address',
            'deliv.districts.DISTRICT_NAME',
              'deliv.districts.amphure.AMPHUR_NAME',
            'deliv.districts.amphure.province.PROVINCE_NAME',
            'deliv.zipcode',
            'deliv.tel',
            //'map',
           [
            'label' => 'หมดอายุ',
            'format' => 'raw',
            'value' => function($model){
        if($model->datecheck==='-'&&$model->status!=2&&$model->status!=3){
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
            'checkbuy',
          
        ],
    ]) ?>

</div>
         </div>
</div>
</div>