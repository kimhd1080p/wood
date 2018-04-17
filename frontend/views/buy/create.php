<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Buy */

$this->title = 'สั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => $modelpro->typeproduct->tpname, 'url' => \yii\helpers\Url::to(['site/index', 'tid' => $modelpro->typeproduct_tpid ])];
$this->params['breadcrumbs'][] = ['label' => $modelpro->pname, 'url' => \yii\helpers\Url::to(['products/view', 'id' => $modelpro->pid ])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-create">
    
    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
               <li class="pull-left header"><i class="fa fa-cart-arrow-down"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

<div class="panel panel-primary">
  <div class="panel-heading"><strong><?= $modelpro->pname ?></strong></div>
  <div class="panel-body text-center">
       <img src="img/<?= $modelpro->pic ?>"  width="250" height="200" class="img-thumbnail"><br><br>
  รหัสสินค้า: <?= $modelpro->pid ?> <?= $modelpro->pname ?> <br/>
  จำนวน: <?= $modelpro->qty ?> <?= $modelpro->unitU->uname ?> <br/>
 
<!--  <button type="button" class="btn btn-success">ชื้อ</button>   <button type="button" class="btn btn-info">รายละเอียด</button>-->
 </div>
  </div>
    <?= $this->render('_form', [
        'model' => $model,
          'modelpro' => $modelpro,
          'modelde' => $modelde,
    ]) ?>

</div>        
 </div>
</div>
</div>