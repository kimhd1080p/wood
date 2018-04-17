<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title ="เปลี่ยนรหัสผ่าน คุณ".$modeluser->name.' '.$modeluser->surname;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-changepassword">
  
    <div class="site-contact">
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-key"> <?=$this->title ?></i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
    
   
    
    <?php $form = ActiveForm::begin(); ?>
        
        
        <?= $form->field($model,'newpass',['inputOptions'=>[
            'placeholder'=>'รหัสผ่านใหม่'
        ]])->passwordInput() ?>
        
        <?= $form->field($model,'repeatnewpass',['inputOptions'=>[
            'placeholder'=>'ยืนยันรหัสผ่านใหม่'
        ]])->passwordInput() ?>
        
        <div class="form-group">
            
                <?= Html::submitButton('เปลี่ยนรหัสผ่าน',[
                    'class'=>'btn btn-primary'
                ]) ?>
        
        </div>
    <?php ActiveForm::end(); ?>
</div>
          </div>
</div>
</div>
