<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BuySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการสั่งซื้อ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-index">
    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
             <li class="pull-left header"><i class="fa fa-cart-arrow-down"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
              
   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
       'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\Column'],
            

            'bid',
            'pricein',
                 'bqty',
            //'products.pname',
            [  
        'label' => 'สินค้า',
        //'value' => 'รหัส '.$model->products->pid.' '.$model->products->pname ,
                 'format' => 'raw',
                'value' => function($model){
                       return  Html::a($model->products->pid." ".$model->products->pname, ['buy/viewproduct', 'id' => $model->bid]);
            }
    ],
            //'datetimeabuy',
             //'datecheck',
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
            //'map',
            
            //'userprofiles_id',
          //  'status',
          'checkbuy',
            //'user_id',

           //['class' => 'yii\grid\ActionColumn'],
            [
  'class' => 'yii\grid\ActionColumn',
  'template'=>'{view} {update} ',
  'options'=> ['style'=>'width:150px;'],
  'buttons'=>[
//    'delete' => function($url,$model,$key){
//        return $model->status !=2 ?  Html::a('', $url, [
//            'class' => 'glyphicon glyphicon-trash',
//            'data' => [
//                'confirm' => "คุณต้องการลบรายการนี้ใช่หรือไม่ ?",
//                'method' => 'post',
//            ],
//        ]): null;
//      },
      'update' => function($url,$model,$key){
        return $model->status !=2 ?  Html::a('', $url, [
            'class' => 'glyphicon glyphicon-pencil',
            'data' => [
                
                'method' => 'post',
            ],
        ]): null;
      }
    ]
],
            
        ],
    ]); ?>
</div>
         </div>
</div>
</div>