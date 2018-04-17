<?php
use yii\web\View;
/* @var $this yii\web\View */

$this->title = 'WoodProductMarket';
?>
  <div class="site-contact">
 <!-- Small boxes (Stat box) -->
   
 <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right"> 
              <li class="pull-left header"><i class="fa fa-pagelines"> สินค้า</i></li>
            </ul>
          <!-- เนื้อหา -->
          <div class="box-body">
              
<div class="row">
    
  <?php //print_r($data->models) 
 // echo $sql;
  ?>
      
    <?php foreach ($data->models as $key => $value)
{
           ?>
<div class="col-xs-6 col-md-3">
  <div class="panel panel-success">
  <div class="panel-heading"><strong><?= $value['pname'] ?></strong></div>
  <div class="panel-body text-center">
      <a href="<?= \yii\helpers\Url::to(['products/view', 'id' => $value['pid']]) ?>"> <img src="img/<?= $value['pic'] ?>"  width="250" height="200" class="img-thumbnail"><br>
  รหัส <?= $value['pid'] ?> <br/><?= $value['pname'] ?> 
   <?= $value['qty'] ?> <?= $value['unit'] ?> <br/>
      </a>
<!--  <button type="button" class="btn btn-success">ชื้อ</button>   <button type="button" class="btn btn-info">รายละเอียด</button>-->
 </div>
  </div>
  </div>
<?php } ?>
   

    
<?php
//$cookies = Yii::$app->response->cookies;
//$cookies->add(new \yii\web\Cookie([
//        'name' => 'time',
//        'value' => 'a',
//        'expire' => time() + 1800,
//]));

    
        $this->registerCss("
            #modal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 25%;
    left: 30%;
    background: rgba(0, 0, 0, 0);
    z-index: 99999;
    height: 730px;
    width: 1100px;
}
.modalconent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    width: 80%;
    padding: 20px;
}
");

?>
</div>
  
  </div>
</div>
</div>
         <?php $show= '<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แนะนำ</h4>
      </div>
      <div class="modal-body">
        <p><iframe width="560" height="315" src="https://www.youtube.com/embed/F0NvoZBYnTY?Version=3&loop=1&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
      </div>
    </div>

  </div>
</div>';
//$cookies1 = Yii::$app->request->cookies;
 if (Yii::$app->request->get('tid')==false&&Yii::$app->request->get('q')==false){
 echo $show;
        
 }
              $this->RegisterJs ( "
                  $(document).ready(function(){
                  $('#myModal').modal();
                  });
            document.getElementById('button').onclick = function () {
        document.getElementById('myModal').style.display = 'none'
    }
        

", View::POS_END);
              ?>    
