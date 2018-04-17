<?php

namespace backend\controllers;

use Yii;
use backend\models\Buy;
use backend\models\Products;
use backend\models\TransferSearch;
use backend\models\Delivery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BuyController implements the CRUD actions for Buy model.
 */
class TransferController extends Controller
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
     * Lists all Buy models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $searchModel = new TransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buy model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $model=$this->findModel($id);
        $sql1="SELECT * FROM products p,productpic pd WHERE p.pid=pd.products_pid and p.pid=$model->products_id";
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
            'model' => $model,
             'picall' => $picall,
        ]);
    }

    /**
     * Creates a new Buy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//          $model = new Buy();
//$modelde = new Delivery();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            
//            return $this->redirect(['view', 'id' => $model->bid]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//            'modelde' => $modelde,
//        ]);
        
//        if (Yii::$app->user->isGuest) {
//            //return $this->render('/site/login');
//            return $this->redirect(['/site/login']);
//        }else {
//                 
//$model = new Buy();
//$modelde = new Delivery();
////$model->load(Yii::$app->request->post()); 
//
//            
//            if($model->load(Yii::$app->request->post())){
//                $check =  Buy::find()->where(['products_id' => $model->products_id,'user_id' => $model->user_id])->count();
//                $check1 = Products::find()->where(['pid' => $model->products_id,'user_id' => $model->user_id])->count();
//            $check2 = Products::find()->where(['pid' => $model->products_id])->andWhere(['>', 'qty', $model->bqty,])->count();
//            if($check>0){
//            Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'คุณได้ทำการสั่งซื้อสินค้าไปแล้ว',
//        'options'=>['class'=>'alert-error']
//     ]);
//            return $this->redirect(['/buy/index']);
//            //exit();
//        }
//       else if($check1>0){
//            Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'ไม่สามารถซื้อสินค้าของตนเองได้',
//        'options'=>['class'=>'alert-error']
//     ]);
//            return $this->redirect(['/buy/index']);
//            //exit();
//        }
//        else if($check2>0){
//            Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'คุณใส่จำนวนสินค้าเกินที่มีขาย',
//        'options'=>['class'=>'alert-error']
//     ]);
//            return $this->redirect(['/buy/index']);
//            //exit();
//        }
//         
//         else if($model->save()) {
//             $modelde->load(Yii::$app->request->post());
//             $modelde->buy_bid=$model->bid;
//             if($modelde->save()&& Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=1 WHERE `pid`=$model->products_id")->execute()){
//                
//                  Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'ทำรายการสั่งซื้อสำเร็จ! ',
//        'options'=>['class'=>'alert-success']
//     ]);
//        return $this->redirect(['/buy/index']);
//             }
//            }  else
//            {
//           
//        return $this->render('/buy/create', [
//            'model' => $model,
//            'modelde' => $modelde,
//            ]);} }
//        else
//            {
//           
//        return $this->render('/buy/create', [
//            'model' => $model,
//            'modelde' => $modelde,
//        ]);
//       
//    }
//    }
    }

    /**
     * Updates an existing Buy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $model = $this->findModel($id);
//        $modelde = $this->findModelde($id);
//        if ($model->load(Yii::$app->request->post()) && $model->save()&&$modelde->load(Yii::$app->request->post()) && $modelde->save()) {
//            return $this->redirect(['view', 'id' => $model->bid]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//             'modelde' => $modelde,
//        ]);
    }

    /**
     * Deletes an existing Buy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
//        $this->findModel($id)->delete();
// $this->findModelde($id)->delete();
//        return $this->redirect(['index']);
    }

    /**
     * Finds the Buy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buy::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelde($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelpo($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
//    public function actionDatenew($id)
//    {
//        $datecheck = date('Y-m-d H:i:s');
//    $q= Yii::$app->db->createCommand("UPDATE `buy` SET `datetimeabuy`='$datecheck' WHERE `bid`=$id")->execute();
//if($q){
//    Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'ต่ออายุเรียบร้อย',
//        'options'=>['class'=>'alert-success']
//     ]);
//        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
//    }
//     
//     return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
//    }
    
//    public function actionAccept($id,$user_id){
//       $model = $this->findModel($id);
////$model->status=1;
//        if (Yii::$app->db->createCommand("UPDATE `buy` SET `status`=1 WHERE `user_id`=$user_id and bid=$id")->execute()&&Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=2 WHERE `pid`=$model->products_id")->execute()) {
//            //Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=2 WHERE `pid`=$id")->execute();
//            Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'ขายเรียบร้อย รอการชำระเงิน.....',
//        'options'=>['class'=>'alert-success']
//     ]);
//             return $this->redirect(['index']);
//        }else {
//        
//   Yii::$app->getSession()->setFlash('alert1',[
//        'body'=>'การทำรายการขายผิดพลาด',
//        'options'=>['class'=>'alert-danger']
//     ]);
//   return $this->redirect(['index']);
//    }
//    
//    }
     public function actionNew($id){
         if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
       $model = $this->findModel($id);
      $modelpo = $this->findModelpo($model->products_id);
//$model->status=1;
        if (Yii::$app->db->createCommand("UPDATE `buy` SET `status`=2 WHERE bid=$id")->execute()) {
            Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=3 WHERE `pid`=$model->products_id")->execute();
            Yii::$app->db->createCommand("UPDATE `products` SET `qty`=qty-$model->bqty WHERE `pid`=$modelpo->pid")->execute();
            //Yii::$app->db->createCommand("UPDATE `products` SET `pstatus`=2 WHERE `pid`=$id")->execute();
            Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'แจ้งโอนเงินแล้ว.....',
        'options'=>['class'=>'alert-success']
     ]);
             return $this->redirect(['index']);
        }else {
        
   Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'แจ้งโอนเงินผิดพลาด',
        'options'=>['class'=>'alert-danger']
     ]);
   return $this->redirect(['index']);
    }
    }
}
