<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BuySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'bid') ?>

    <?php // $form->field($model, 'pricein') ?>

    <?php //$form->field($model, 'datetimeabuy') ?>

    <?php //$form->field($model, 'map') ?>

    <?php //$form->field($model, 'products_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php  echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('ล้าง', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
