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

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'typeproduct_tpid')->textInput()
            ->dropDownList(
            ArrayHelper::map(Typeproduct::find()->asArray()->all(), 'tpid', 'tpname'),['prompt'=>'เลือก']
            ) ?>
    <?= $form->field($model, 'pname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>
     
     <?= $form->field($model, 'unit_uid')->textInput()
            ->dropDownList(
            ArrayHelper::map(frontend\models\Unit::find()->asArray()->all(), 'uid', 'uname'),['prompt'=>'เลือก']
            ) ?>

    <?= $form->field($model, 'detials')->textInput(['maxlength' => true]) ?>

 
     <?= $form->field($model, 'typebuy_id')->textInput()
            ->dropDownList(
            ArrayHelper::map(frontend\models\Typebuy::find()->asArray()->all(), 'tbid', 'tbname'),['prompt'=>'เลือก']
            ) ?>

    <?php  //$form->field($model, 'map')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>

   


    <?php $model->user_id=Yii::$app->user->identity->id ?>
    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
