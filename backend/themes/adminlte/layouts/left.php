<?php
//use Yii;
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">
  <br />
        <!-- Sidebar user panel -->
<!--        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        
        <!-- /.search form -->

<ul class="sidebar-menu">

<li class="active"><a href=""><i class="fa fa-circle-o"></i>  <span>รายการสั่งซื้อ</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu menu-open" style="display: block;">
<li><a href="<?= \yii\helpers\Url::to(['buy/index']) ?>"><i class="fa fa-circle-o"></i>  <span>รายการสั่งซื้อเข้า</span></a></li>
<li><a href="<?= \yii\helpers\Url::to(['transfer/index']) ?>"><i class="fa fa-circle-o"></i>  <span>แจ้งโอนเงิน</span></a></li>
<li><a href="<?= \yii\helpers\Url::to(['delivery/index']) ?>"><i class="fa fa-circle-o"></i>  <span>แจ้งการจัดส่ง</span></a></li>

</ul>
</li>
<li class="active"><a href=""><i class="fa fa-circle-o"></i>  <span>จัดการ</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu menu-open" style="display: block;">
<li><a href="<?= \yii\helpers\Url::to(['user/index']) ?>"><i class="fa fa-circle-o"></i>  <span>ลูกค้า</span></a></li>
<li><a href="<?= \yii\helpers\Url::to(['typeproduct/index']) ?>"><i class="fa fa-circle-o"></i>  <span>ประเภทสินค้า</span></a></li>
<li><a href="<?= \yii\helpers\Url::to(['typebuy/index']) ?>"><i class="fa fa-circle-o"></i>  <span>ประเภทการขาย</span></a></li>

<li><a href="<?= \yii\helpers\Url::to(['admin/index']) ?>"><i class="fa fa-circle-o"></i>  <span>ผู้ใช้ระบบ</span></a></li>

</ul>
</li>
<!--<li><a href="/hospitalservice/web/tool/index"><i class="fa fa-circle-o"></i>  <span>จัดการ</span></a></li>-->
</ul>
        

    </section>

</aside>
