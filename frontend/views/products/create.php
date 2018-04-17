<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Products */

$this->title = 'เพิ่มสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'ขายสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-cart-plus"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
              
<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelu' => $modelu,
    ]) ?>

</div>
         </div>
</div>
</div>