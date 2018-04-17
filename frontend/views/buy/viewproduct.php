<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



$this->title = $model->products->pname;
$this->params['breadcrumbs'][] = ['label' => 'รายการสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    
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
            <?= Html::img('img'.'/'.$model->products->pic); ?>
    </div>
      <?php foreach ($picall->models as $key => $value)
{
               
           ?>
               
                 <div class="item">
     <?= Html::img('img'.'/'.$value['picname']); ?>
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


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'products.pid',
            'products.pname',
            'products.price',
            'products.qty',
            'products.datetimeadd',
            'products.detials',
            //'typebuy_id',
            'products.typebuy.tbname',
            //'map',
            //'pic',
            //'typeproduct_tpid',
            'products.typeproduct.tpname',
            'products.unit',
            //'user_id',
        ],
    ]) ?>
              </br/>

      
      
      
      
      
      
      </div>
          </div>
</div>
      
      
      </div>
  <div class="col-md-4"> </div>
</div>
      
      
      
      
  

</div>
