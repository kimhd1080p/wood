<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Buy */

$this->title = 'แก้ไขการซื้อ';
$this->params['breadcrumbs'][] = ['label' => 'รายการสั่งซื้อเข้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-update">

    

    <?= $this->render('_form', [
        'model' => $model,
            'modelde' => $modelde,
    ]) ?>

</div>
