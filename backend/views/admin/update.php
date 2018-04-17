<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'แก้ไข '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้งานระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-update">
<div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-user"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    

    <?= $this->render('_formedit', [
        'model' => $model,
    ]) ?>

</div>
</div>
          </div>