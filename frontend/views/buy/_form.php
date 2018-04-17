<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
 use frontend\models\Provinces;
 use frontend\models\Amphures;
  use frontend\models\Zipcodes;
   use frontend\models\Districts;
use kartik\widgets\DepDrop;
/* @var $this yii\web\View */
/* @var $model frontend\models\Buy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pricein')->textInput() ?>
 <?= $form->field($model, 'bqty')->textInput() ?>
   <?= $form->field($modelde, 'address')->textArea(['maxlength' => true]) ?>
  
    <?= $form->field($model, 'provice')->textInput()
            ->dropDownList(
            ArrayHelper::map(Provinces::find()->asArray()->all(),  'PROVINCE_ID',
            'PROVINCE_NAME'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
]); ?>
  <?= $form->field($model, 'amphures')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> [],
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/user/get-amphur'])
            ]
        ]); ?>
    
    <?= $form->field($modelde, 'districts_DISTRICT_ID')->widget(DepDrop::classname(), [
        'options'=>['id'=>'ddl-district'],
           'data' =>[],
           'pluginOptions'=>[
               'depends'=>['ddl-province', 'ddl-amphur'],
               'placeholder'=>'เลือกตำบล...',
               'url'=>Url::to(['/user/get-district'])
           ]
]); ?>
   
    
   

   

    <?= $form->field($modelde, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($modelde, 'tel')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'products_id')->hiddenInput(['value'=>$modelpro->pid])->label(false); ?>
     <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>
    

    <div class="form-group">
        <?= Html::submitButton('ยืนยันการซื้อ', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
