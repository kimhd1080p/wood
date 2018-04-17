<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">Wood</span><span class="logo-lg"> จัดการร้านค้าไม้ </span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    
    <nav class="navbar navbar-static-top" role="navigation">
    <div class="" style="margin-right:20px;">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!--div class="navbar-custom-menu"-->
            <ul class="nav navbar-nav navbar-right">
               
              <ul id="w4" class="nav-pills nav">
                  <?php  if(!Yii::$app->user->isGuest):?>

            <li class="pull-right dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown"> <?= Yii::$app->user->identity->u_name ?>  <b class="caret">
        </b></a><ul id="w5" class="dropdown-menu"><li><a href="<?= \yii\helpers\Url::to(['admin/view','id' => Yii::$app->user->identity->username]) ?>" tabindex="-1"><i class="fa fa-user" aria-hidden="true"></i> ข้อมูลส่วนตัว</a></li>
<li><a href="<?= \yii\helpers\Url::to(['admin/changepassword','username' => Yii::$app->user->identity->username]) ?>" tabindex="-1"><i class="fa fa-key" aria-hidden="true"></i> เปลี่ยนรหัสผ่าน</a></li>
<li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" tabindex="-1"><i class="fa fa-sign-out" aria-hidden="true"></i> ลงชื่อออก</a></li>
        </ul></li>
                 <?php else: ?>
      
                
                
                
  <?php endif;?>
              </ul>
                
            </ul>
        <!--/div-->
      </div>
    </nav>
    
                <!-- User Account: style can be found in dropdown.less -->
<!--                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>-->
         
</header>
