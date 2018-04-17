<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Buy */

$this->title = 'แก้ไขการซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'รายการสั่งซื้อเข้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-update">

    <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-cart-plus"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
            'modelde' => $modelde,
    ]) ?>

</div>
          </div>
</div>
</div>