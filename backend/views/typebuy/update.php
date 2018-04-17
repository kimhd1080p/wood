<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Typebuy */

$this->title = 'แก้ไข '.$model->tbname;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทการขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typebuy-update">

   <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-tree"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
          </div>