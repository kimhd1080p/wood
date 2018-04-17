<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title ="ข้อมูลสมาชิก";
//$this->params['breadcrumbs'][] = ['label' => 'ผู้ใช้', 'url' => ['index']];
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