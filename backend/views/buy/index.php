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

$this->title = 'รายการสั่งซื้อเข้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-index">

    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-cart-plus"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('สั่งซื้อแทนลูกค้า', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
          'responsiveWrap' => false,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            'bid',
   // 'products_id',
            //'products_id',
            [
                'attribute' => 'products_id',
                'filter'=> ArrayHelper::map(Products::find()->where("qty >= 0")->andWhere("pstatus = 1")->orWhere("pstatus = 2")->orWhere("pstatus = 3")->orderBy([
           'pstatus'=>SORT_ASC,
           //'username' => SORT_DESC,
        ])->all(), 'pid', 'pname'),
                   'format' => 'raw',
            'value' => function($model){
               // return "รหัส ".$model->products->pid." ".$model->products->pname;
                 return  Html::a($model->products->pid." ".$model->products->pname, ['buy/viewproduct', 'id' => $model->bid]);
            }
            ],
                     'pricein',
            [
                'label' => 'จำนวนคงเหลือ',
                'format' => 'raw',
            'value' => function($model){
                //return $model->user->name.' '.$model->user->surname;
                 return  $model->products->qty;
            }
            ],
           
                  'bqty',     
            //'datetimeabuy',
            //'map',
        
            //'status',
            //'user.name',
                    [
                'label' => 'ชื่อลูกค้า',
                'format' => 'raw',
            'value' => function($model){
                //return $model->user->name.' '.$model->user->surname;
                 return  Html::a($model->user->name.' '.$model->user->surname, ['user/view', 'id' => $model->user->id]);
            }
            ],
              [
            'label' => 'ขาย',
            'format' => 'raw',
            'value' => function($model){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('ขาย', ['buy/accept', 'id' => $model->bid,'user_id' => $model->user_id], [
            'class' => 'btn btn-success btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องการขายสินค้าให้กับ คุณ'.$model->user->name.' '.$model->user->surname.' ใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            }      
        ],  
                  
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
   
                    
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
                   </div>
</div>