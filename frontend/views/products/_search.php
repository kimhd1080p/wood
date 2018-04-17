<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pid') ?>

    <?= $form->field($model, 'pname') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'datetimeadd') ?>

    <?php // echo $form->field($model, 'detials') ?>

    <?php // echo $form->field($model, 'typebuy_id') ?>

    <?php // echo $form->field($model, 'map') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'typeproduct_tpid') ?>

    <?php // echo $form->field($model, 'unit_uid') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
