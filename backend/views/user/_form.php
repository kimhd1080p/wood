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
/* @var $model frontend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

  

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
<?= $form->field($model, 'passwordconfirm')->passwordInput(['maxlength' => true]) ?>
   
 

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

   
 <?= $form->field($model, 'address')->textArea(['maxlength' => true]) ?>
  
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
    
    <?= $form->field($model, 'districts_DISTRICT_ID')->widget(DepDrop::classname(), [
        'options'=>['id'=>'ddl-district'],
           'data' =>[],
           'pluginOptions'=>[
               'depends'=>['ddl-province', 'ddl-amphur'],
               'placeholder'=>'เลือกตำบล...',
               'url'=>Url::to(['/user/get-district'])
           ]
]); ?>
   
    
   

   

    <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton('สมัครสมาชิก', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
