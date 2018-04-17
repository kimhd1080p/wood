<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
 use frontend\models\Typeproduct;

/* @var $this yii\web\View */
/* @var $model frontend\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

   <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

     <?= $form->field($model, 'typeproduct_tpid')->textInput()
            ->dropDownList(
            ArrayHelper::map(Typeproduct::find()->asArray()->all(), 'tpid', 'tpname'),['prompt'=>'เลือก']
            ) ?>
    <?= $form->field($model, 'pname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>
     
     <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detials')->textarea(['maxlength' => true]) ?>

 
     <?= $form->field($model, 'typebuy_id')->textInput()
            ->dropDownList(
            ArrayHelper::map(frontend\models\Typebuy::find()->asArray()->all(), 'tbid', 'tbname'),['prompt'=>'เลือก']
            ) ?>

    <?php  //$form->field($model, 'map')->textInput(['maxlength' => true]) ?>



   
    <?= $form->field($modelu, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

   
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('ขาย', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
