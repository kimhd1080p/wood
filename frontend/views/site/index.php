<?php

/* @var $this yii\web\View */

$this->title = 'WoodProductMarket';
?>
  <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-pagelines"> สินค้า</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
              
<div class="row">
    
  <?php //print_r($data->models) 
 // echo $sql;
  ?>
      
    <?php foreach ($data->models as $key => $value)
{
           ?>
<div class="col-xs-6 col-md-3">
  <div class="panel panel-success">
  <div class="panel-heading"><strong><?= $value['pname'] ?></strong></div>
  <div class="panel-body text-center">
      <a href="<?= \yii\helpers\Url::to(['products/view', 'id' => $value['pid']]) ?>"> <img src="img/<?= $value['pic'] ?>"  width="250" height="200" class="img-thumbnail"><br>
  รหัส <?= $value['pid'] ?> <br/><?= $value['pname'] ?> 
   <?= $value['qty'] ?> <?= $value['unit'] ?> <br/>
      </a>
<!--  <button type="button" class="btn btn-success">ชื้อ</button>   <button type="button" class="btn btn-info">รายละเอียด</button>-->
 </div>
  </div>
  </div>
<?php } ?>
   
 

</div>
  
  </div>
</div>
</div>
              