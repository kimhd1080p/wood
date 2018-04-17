<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title ="ข้อมูลลูกค้า คุณ".$model->name.' '.$model->surname;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
                <li class="pull-left header"><i class="fa fa-user"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

<!--    <h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
         <?= Html::a('เปลี่ยนรหัสผ่าน', ['changepassword', 'email' => $model->email], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
           
           
            'name',
            'surname',
            'address',
            'district.DISTRICT_NAME',
            'district.amphure.AMPHUR_NAME',
            'district.amphure.province.PROVINCE_NAME',
            'zipcode',
            'tel',
            //'districts_DISTRICT_ID',
        ],
    ]) ?>

</div>
</div>
          </div>
</div>