<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">Wood</span><span class="logo-lg"> Wood Mart </span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    
    <nav class="navbar navbar-static-top" role="navigation">
    <div class="" style="margin-right:20px;">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!--div class="navbar-custom-menu"-->
            <ul class="nav navbar-nav navbar-right">
               
              <ul id="w4" class="nav-pills nav">
                  <?php  if(!Yii::$app->user->isGuest):?>
       <li><a href="<?= \yii\helpers\Url::to(['products/index']) ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs">ขายสินค้า</span></a></li>
<li ><a href="<?= \yii\helpers\Url::to(['buy/index']) ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span class="hidden-xs">รายการซื้อ</span></a></li>
            <li class="pull-right dropdown"><a class="dropdown-toggle" href="" data-toggle="dropdown"> <?= Yii::$app->user->identity->name ?> <?= Yii::$app->user->identity->surname ?> <b class="caret">
        </b></a><ul id="w5" class="dropdown-menu"><li><a href="<?= \yii\helpers\Url::to(['user/view','id' => Yii::$app->user->identity->id]) ?>" tabindex="-1"><i class="fa fa-user" aria-hidden="true"></i> ข้อมูลส่วนตัว</a></li>
<li><a href="<?= \yii\helpers\Url::to(['user/changepassword']) ?>" tabindex="-1"><i class="fa fa-key" aria-hidden="true"></i> เปลี่ยนรหัสผ่าน</a></li>
<li><a href="<?= \yii\helpers\Url::to(['site/logout']) ?>" tabindex="-1"><i class="fa fa-sign-out" aria-hidden="true"></i> ลงชื่อออก</a></li>
        </ul></li>
                 <?php else: ?>
       <li><a href="<?= \yii\helpers\Url::to(['products/index']) ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i> <span class="hidden-xs">ขายสินค้า</span></a></li>
      <li class="pull-right dropdown"><a class="dropdown-toggle" href="<?= \yii\helpers\Url::to(['stie/login']) ?>" data-toggle="dropdown"> ผู้ใช้ <b class="caret">
        </b></a><ul id="w5" class="dropdown-menu">
<li><a href="<?= \yii\helpers\Url::to(['user/create']) ?>" tabindex="-1"><i class="fa fa-user" aria-hidden="true"></i> สมัครสมาชิก</a></li>
<li><a href="<?= \yii\helpers\Url::to(['site/login']) ?>" tabindex="-1"><i class="fa fa-sign-in" aria-hidden="true"></i> เข้าสู่ระบบ</a></li>
        </ul></li>


                
                
                
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
