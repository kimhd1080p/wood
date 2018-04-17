<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
 use backend\models\Products;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการโอนเงิน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-index">

     <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-money"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

  

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'bid',
   // 'products_id',
            //'products_id',
            [
                'attribute' => 'products_id',
                'filter'=> ArrayHelper::map(Products::find()->where(['pstatus' => 2])->orWhere(['pstatus' => 3])->orderBy([
           'pstatus'=>SORT_ASC,
           //'username' => SORT_DESC,
        ])->all(), 'pid', 'pname'),
                  'format' => 'html',
            'value' => function($model){
                return "รหัส ".$model->products->pid." ".$model->products->pname;
            }
            ],
            'pricein',
                  'bqty',     
            //'datetimeabuy',
            //'map',
        
            //'status',
            //'user.name',
                    [
                'label' => 'ชื่อลูกค้า',
                
            'value' => function($model){
                return $model->user->name.' '.$model->user->surname;
            }
            ],
               
                [
            'label' => 'แจ้งโอนเงิน',
            'format' => 'raw',
            'value' => function($model){
        if($model->transfercheck===0){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('แจ้งโอนเงิน', ['transfer/new', 'id' => $model->bid], [
            'class' => 'btn btn-success btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องแจ้งโอนเงินใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            } else{return $model->transfercheck; }
            }
        ],
                
                [
            'label' => 'ยกเลิก',
            'format' => 'raw',
            'value' => function($model){
            if($model->status==2){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('ยกเลิกโอนเงิน', ['buy/ctransfer', 'id' => $model->bid], [
            'class' => 'btn btn-danger btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องยกเลิกการโอนเงิน คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            }
           
            
          else  if($model->status==3){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('ยกเลิกการจัดส่ง', ['buy/cdeli', 'id' => $model->bid], [
            'class' => 'btn btn-danger btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องยกเลิกการจัดส่ง คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            }else{
                
                return  Html::a('ยกเลิกขาย', ['buy/cbuy', 'id' => $model->bid,'user_id' => $model->user_id], [
            'class' => 'btn btn-danger btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องยกเลิกการขายสินค้าให้กับ คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
                
            }
            }
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
//                return  Html::a('ยกเลิกโอนเงิน', ['buy/ctransfer', 'id' => $model->bid], [
//            'class' => 'btn btn-danger btn-xs',
//        'data-pjax' => 0,
//            'data' => [
//                'confirm' => 'คุณต้องยกเลิกการขายสินค้าให้กับ คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
//                'method' => 'post',
//            ],
//        ]);
            //}      
        ],
//                [
//            'label' => 'ยกเลิกขาย',
//            'format' => 'raw',
//            'value' => function($model){
//                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
//                return  Html::a('ยกเลิกขาย', ['buy/cbuy', 'id' => $model->bid,'user_id' => $model->user_id], [
//            'class' => 'btn btn-danger btn-xs',
//        'data-pjax' => 0,
//            'data' => [
//                'confirm' => 'คุณต้องยกเลิกการขายสินค้าให้กับ คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
//                'method' => 'post',
//            ],
//        ]);
//            }      
//        ],
   
                    
           

            //['class' => 'yii\grid\ActionColumn'],
                [
  'class' => 'yii\grid\ActionColumn',
  'template'=>'{view} ',
  //'options'=> ['style'=>'width:150px;'],
 
],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
          </div>
</div>