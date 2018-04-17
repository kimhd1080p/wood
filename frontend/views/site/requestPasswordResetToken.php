<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'ลืมรหัสผ่าน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
                <li class="pull-left header"><i class="fa fa-user"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    

    <p>ลิงค์ในการกู้คืนรหัสผ่านจะถูกส่งไปยังอีเมล กรุณาตรวจสอบอีเมลของท่าน</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('ส่ง', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
            </div>
</div>