<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Buy;
use frontend\models\Delivery;
use frontend\models\Products;
use frontend\models\BuySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BuyController implements the CRUD actions for Buy model.
 */
class BuyController extends Controller
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
        $searchModel = new BuySearch();
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewproduct($id)
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
        
        return $this->render('viewproduct', [
            'model' => $model,
             'picall' => $picall,
        ]);
    }

    /**
     * Creates a new Buy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        
//        $model = new Buy();
//$modelde = new Delivery();
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            
//            return $this->redirect(['view', 'id' => $model->bid]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Updates an existing Buy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $model = $this->findModel($id);
        $modelde = $this->findModelde($id);
        
         $model->provice=$modelde->districts->amphure->province->PROVINCE_ID;
         $model->amphures=$modelde->districts->amphure->AMPHUR_ID;
        //$model->zipcode=$modelde->districts->zipcode->zipcode;
         
        if ($model->load(Yii::$app->request->post())&&$modelde->load(Yii::$app->request->post())) {
              $check2 = Products::find()->where(['pid' => $model->products_id])->andWhere(['<', 'qty', $model->bqty,])->count();
              if($check2>0){
                  Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'คุณใส่จำนวนสินค้าเกินที่มีขาย',
        'options'=>['class'=>'alert-error']
     ]);
             return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
                  // return $this->redirect(['/site/index']);
             }else if($model->save()&&$modelde->save()){
                 Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'แก้ไขข้อมูลแล้ว',
        'options'=>['class'=>'alert-success']
     ]);
                 
            return $this->redirect(['index']);
        }
        else{
                  Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'ผิดพลาด',
        'options'=>['class'=>'alert-error']
     ]);
                   return $this->redirect(['/site/index']);
             }
        
        }
        return $this->render('update', [
            'model' => $model,
             'modelde' => $modelde,
        ]);
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
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $this->findModel($id)->delete();
 $this->findModelde($id)->delete();
        return $this->redirect(['index']);
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
    public function actionDatenew($id)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $datecheck = date('Y-m-d H:i:s');
    $q= Yii::$app->db->createCommand("UPDATE `buy` SET `datetimeabuy`='$datecheck' WHERE `bid`=$id")->execute();
if($q){
    Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'ต่ออายุเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
     
     return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }
    
}
