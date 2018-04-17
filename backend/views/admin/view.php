<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'ดู '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้งานระบบ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

   <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-user"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->username], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('เปลี่ยนรหัสผ่าน', ['changepassword', 'username' => $model->username], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->username], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'auth_key',
            //'password_hash',
            'password_reset_token',
            'email:email',
            //'status',
           // 'created_at',
            //'updated_at',
            'u_name',
            'mobilephone',
        ],
    ]) ?>

</div>
</div>
          </div>