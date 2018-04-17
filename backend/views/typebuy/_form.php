<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Typebuy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="typebuy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tbname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
