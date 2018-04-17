<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Typebuy */

$this->title = 'ดู '.$model->tbname;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทการขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="typebuy-view">

   <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-tree"> <?=$this->title?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->tbid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->tbid], [
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
            'tbid',
            'tbname',
        ],
    ]) ?>

</div>
</div>
          </div>