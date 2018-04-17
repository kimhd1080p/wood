<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Products;
use frontend\models\ProductsSearch;
use frontend\models\UploadForm;
use frontend\models\Buy;
use frontend\models\Delivery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
         if (Yii::$app->user->isGuest) {
            //return $this->render('/site/login');
            return $this->redirect(['/site/login']);
        }else{
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }}

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
//        if (Yii::$app->user->isGuest) {
//            //return $this->render('/site/login');
//            return $this->redirect(['/site/login']);
//        }else{
        
       $sql1="SELECT * FROM products p,productpic pd WHERE p.pid=pd.products_pid and p.pid=$id";
                
        try {
            $rawData1= \yii::$app->db->createCommand($sql1)->queryAll();
            
        } catch (\yii\db\Exception $exc) {
            throw new \yii\web\ConflictHttpException("sql error");
        }
        $picall= new \yii\data\ArrayDataProvider([
            'allModels' => $rawData1,
            'pagination'=>FALSE
        ]);
       
        
       
        return $this->render('view', [
            'model' => $this->findModel($id),
            'picall' => $picall,
        ]);
//    }
    }
    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            //return $this->render('/site/login');
            return $this->redirect(['/site/login']);
        }else{
        $model = new Products();
        $modelu = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
             $modelu->imageFiles = UploadedFile::getInstances($modelu, 'imageFiles');
           $randomName = Yii::$app->getSecurity()->generateRandomString(32);
           $t=time();
            
            if ($modelu->upload($randomName.$t)) {
                $model->pic=$randomName.$t. '0.' .$modelu->imageFiles[0]->extension;
                
                //$model->pic=$modelu->upload()[0];
               
                if ($model->save()){
             
                    for($i=1;$i<count($modelu->imageFiles);$i++){
  $picname=$randomName.$t.$i. '.' .$modelu->imageFiles[$i]->extension;
  $id=$model->pid;
 Yii::$app->db->createCommand("INSERT INTO `productpic`(`picid`, `picname`, `products_pid`) VALUES ('','$picname','$id')")->execute();
   Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'เพิ่มการขายเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
                }
               return $this->redirect(['view', 'id' => $model->pid]);
                }
            }
          
           //$modelu->imageFiles->baseName=$modelu->imageFiles->baseName.'000';
              
            
            
            
        }

        return $this->render('create', [
            'model' => $model,
              'modelu' => $modelu,
        ]);
    }

    }
    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            //return $this->render('/site/login');
            return $this->redirect(['/site/login']);
        }else{
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'แก้ไขข้อมูลการขายเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
            return $this->redirect(['view', 'id' => $model->pid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    }
    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            //return $this->render('/site/login');
            return $this->redirect(['/site/login']);
        }else{
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
     public function actionBuy($id)
    {
       

        if (Yii::$app->user->isGuest) {
            //return $this->render('/site/login');
            return $this->redirect(['/site/login']);
        }
$modelpro = $this->findModel($id);       
$model = new Buy();
$modelde = new Delivery();
$check =  Buy::find()->where(['products_id' => $id,'user_id' => Yii::$app->user->identity->id])->count();


          if($model->load(Yii::$app->request->post())) {
             $modelde->load(Yii::$app->request->post());
        
             $check2 = Products::find()->where(['pid' => $model->products_id])->andWhere(['<', 'qty', $model->bqty,])->count();
    
//              if($check>0){
//            Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'คุณได้ทำการสั่งซื้อสินค้าไปแล้ว',
//        'options'=>['class'=>'alert-error']
//     ]);
//            return $this->redirect(['/site/index']);
//            //exit();
//        }
//         else 
         if(Yii::$app->user->identity->id==$modelpro->user_id){
            Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'คุณไม่สามารถซื้อสินค้าของตนเองได้',
        'options'=>['class'=>'alert-error']
     ]);
            return $this->redirect(['/site/index']);
            //exit();
        }
       else if($check2>0){
                  Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'คุณใส่จำนวนสินค้าเกินที่มีขาย',
        'options'=>['class'=>'alert-error']
     ]);
             return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
                  // return $this->redirect(['/site/index']);
             }
         else if($model->save()){
                  $modelde->buy_bid=$model->bid;
             $modelde->save();
              Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=1 WHERE `pid`=$id")->execute();
              //   
                
                //$model->save();
                  Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'ทำรายการสั่งซื้อสำเร็จ! เจ้าหน้าที่จะติดต่อกลับไปเร็วที่สุด..',
        'options'=>['class'=>'alert-success']
     ]);
        return $this->redirect(['/site/index']);
             }
             else{
                  Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'ผิดพลาด',
        'options'=>['class'=>'alert-error']
     ]);
                   return $this->redirect(['/site/index']);
             }
         }
         
        else
            {
            $modelde->address=Yii::$app->user->identity->address;
            $modelde->districts_DISTRICT_ID=Yii::$app->user->identity->districts_DISTRICT_ID;
             $modelde->tel=Yii::$app->user->identity->tel;
                $modelde->zipcode=Yii::$app->user->identity->zipcode;
        return $this->render('/buy/create', [
            'model' => $model,
            'modelpro' => $modelpro,
            'modelde' => $modelde,
        ]);
       
    }
    }
    
}
