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
        <form action="<?= \yii\helpers\Url::to(['site/index']) ?>" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="ค้นหา..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

       <?php
       $sql1="SELECT * FROM `typeproduct`";
                
        try {
            $rawData1= \yii::$app->db->createCommand($sql1)->queryAll();
            
        } catch (\yii\db\Exception $exc) {
            throw new \yii\web\ConflictHttpException("sql error");
        }
        $dataProvider1= new \yii\data\ArrayDataProvider([
            'allModels' => $rawData1,
            'pagination'=>FALSE
        ]);
       
        //print_r($dataProvider1->models);
       ?>
        <?php
//        Nav::widget(
//            [
//                'encodeLabels' => false,
//                'options' => ['class' => 'sidebar-menu'],
//                'items' => [
//                    '<li class="header">Menu Yii2</li>',
//                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
//                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
//                    [
//                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
//                        'url' => ['/site/login'],
//                        'visible' =>Yii::$app->user->isGuest
//                    ],
//                ],
//            ]
//        );
        ?>

        <ul class="sidebar-menu">
             <li><a href="<?= \yii\helpers\Url::to(['site/index']) ?>"><span class="fa fa-tree"></span> สินค้าทั้งหมด</a>
                    </li>
           <?php foreach ($dataProvider1->models as $key => $value)
{
               
           ?>
                
                   
                    <li><a href="<?= \yii\helpers\Url::to(['site/index', 'tid' => $value['tpid'] ]) ?>"><span class="fa fa-tree"></span> <?= $value['tpname'] ?></a>
                    </li>
                    
                
<?php } ?>
        </ul>

    </section>

</aside>
