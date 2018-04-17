<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Products */

$this->title = 'Update Products: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pid, 'url' => ['view', 'id' => $model->pid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->
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
    ]) ?>

    
</div>
          </div>
</div>
</div>