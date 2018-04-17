<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
 use frontend\models\Typeproduct;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ขายสินค้า';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-cart-plus"> คลังสินค้า</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('ขายสินค้าใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
           'responsiveWrap' => false,
        'columns' => [
            ['class' => 'yii\grid\Column'],

            //'pid',
            
            'pname',
            //'typeproductTp.tpname',
            [
                'attribute' => 'typeproduct_tpid',
                'filter'=> ArrayHelper::map(Typeproduct::find()->all(), 'tpid', 'tpname'),
                  'format' => 'html',
            'value' => function($model){
                return $model->typeproduct->tpname;
            }
            ],
            'price',
            'qty',
            
            //'datetimeadd',
            //'detials',
            //'typebuy_id',
            //'map',
            //'pic',
            //'typeproduct_tpid',
            //'unit_uid',
            //'user_id',
                   //'pbcount',  

         [
  'class' => 'yii\grid\ActionColumn',
  'template'=>'{view} {delete}',
  'options'=> ['style'=>'width:150px;'],
  'buttons'=>[
    'delete' => function($url,$model,$key){
        return $model->pbcount == 0 ?  Html::a('', $url, [
            'class' => 'glyphicon glyphicon-trash',
            'data' => [
                'confirm' => "คุณต้องการลบรายการนี้ใช่หรือไม่ ?",
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
