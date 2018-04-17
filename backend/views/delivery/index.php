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

$this->title = 'รายการจัดส่ง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-index">
    
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
            'label' => 'จัดส่ง',
            'format' => 'raw',
            'value' => function($model){
        if($model->delicheck===0){
                //return Html::a('ขาย', ['buy/accept'], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
                return  Html::a('แจ้งจัดส่ง', ['delivery/new', 'id' => $model->bid], [
            'class' => 'btn btn-success btn-xs',
        'data-pjax' => 0,
            'data' => [
                'confirm' => 'คุณต้องแจ้งจัดส่งใช่หรือไม่ ?',
                'method' => 'post',
            ],
        ]);
            } else{return $model->delicheck; }
            }
        ],
   
                    
           

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

