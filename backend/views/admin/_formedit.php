<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?php //echo $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

   

    <?php // echo $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

   

    <?php // echo $form->field($model, 'status')->textInput() ?>

    <?php // echo $form->field($model, 'created_at')->textInput() ?>

    <?php // echo $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'u_name')->textInput(['maxlength' => true]) ?>
     <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobilephone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
