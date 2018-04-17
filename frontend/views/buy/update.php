<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Buy */



$this->title = 'แก้ไขรายการสั่งซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'รายการสั่งซื้อ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="buy-update">

     <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
            <li class="pull-left header"><i class="fa fa-cart-arrow-down"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
   

    <?= $this->render('_form_user', [
        'model' => $model,
        'modelde' => $modelde,
    ]) ?>

</div>
         </div>
</div>
</div>