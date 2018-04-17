<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\UserPass;
use frontend\models\Amphures;
use frontend\models\Districts;
use frontend\models\UserSearch;
use frontend\models\Zipcodes;
use frontend\models\PasswordForm;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
   
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    
                    [
                        'actions' => ['changepassword'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new UserSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    /**
     * Displays a single User model.
     * @param string $id
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
    
     public function actionViewg($id)
    {
        return $this->render('viewg', [
            'model' => $this->findModelg($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())&&$model->save()) {
            //$model->password_hash=Yii::$app->security->generatePasswordHash($model->password_hash);
              
            Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'สมัครสมาชิกเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
            return $this->redirect(['viewg', 'id' => $model->id]);
        }
$model->password_hash==null;
$model->passwordconfirm==null;
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $model = $this->findModelEdit($id);
 $add = $this->findAdd($model->districts_DISTRICT_ID);
         $model->provice=$add->amphure->province->PROVINCE_ID;
         $model->amphures=$add->amphure->AMPHUR_ID;
//         if(!$model->zipcode=$add->zipcode->zipcode){
//             $model->zipcode="";
//         }
        if ($model->load(Yii::$app->request->post()) && $model->save()&&$model->id==Yii::$app->user->identity->id) {
            
                Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'แก้ไขข้อมูลเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//    public function actionDelete($id)
//    {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null&&$id === Yii::$app->user->identity->id) {
            return $model;
        }
        

        throw new NotFoundHttpException('The requested page does not exist.');
    }
       protected function findModelg($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function getAmphur($id){
     $datas = Amphures::find()->where(['PROVINCE_ID'=>$id])->all();
     return $this->MapData($datas,'AMPHUR_ID','AMPHUR_NAME');
 }
    public function actionGetAmphur() {
     $out = [];
     if (isset($_POST['depdrop_parents'])) {
         $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
             $province_id = $parents[0];
             $out = $this->getAmphur($province_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
     }
     echo Json::encode(['output'=>'', 'selected'=>'']);
 }
 
  protected function getDistrict($id){
     $datas = Districts::find()->where(['AMPHUR_ID'=>$id])->all();
     return $this->MapData($datas,'DISTRICT_ID','DISTRICT_NAME');
 }
  public function actionGetDistrict() {
     $out = [];
     if (isset($_POST['depdrop_parents'])) {
         $ids = $_POST['depdrop_parents'];
         $province_id = empty($ids[0]) ? null : $ids[0];
         $amphur_id = empty($ids[1]) ? null : $ids[1];
         if ($province_id != null) {
            $data = $this->getDistrict($amphur_id);
            echo Json::encode(['output'=>$data, 'selected'=>'']);
            return;
         }
     }
     echo Json::encode(['output'=>'', 'selected'=>'']);
 }
 
  protected function MapData($datas,$fieldId,$fieldName){
     $obj = [];
     foreach ($datas as $key => $value) {
         array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
     }
     return $obj;
 }
  protected function findAdd($id)
    {
        if (($model = Districts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelEdit($id)
    {
        if (($model = \frontend\models\UserEdit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
     public function actionChangepassword(){
         if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $model = new PasswordForm;
        $modeluser = UserPass::find()->where([
            'email'=>Yii::$app->user->identity->email
        ])->one();
      
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $modeluser->password_hash = $model->newpass;
                    $modeluser->password_hash=Yii::$app->security->generatePasswordHash($modeluser->password_hash);
                    if($modeluser->save()){
   
                       Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'เปลี่ยนรหัสผ่านเรียบร้อย',
        'options'=>['class'=>'alert-success']
     ]);
                        return $this->redirect(['site/index']);
                    }else{
                       
                       
                             Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'เปลี่ยนรหัสผ่านผิดพลาด'.$modeluser->password_hash,
        'options'=>['class'=>'alert-error']
     ]);
                        return $this->redirect(['site/index']);
                    }
                }catch(Exception $e){
 
                   Yii::$app->getSession()->setFlash('alert1',[
        'body'=>'เปลี่ยนรหัสผ่านผิดพลาด '.$e,
        'options'=>['class'=>'alert-error']
     ]);
                    return $this->render('changepassword',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('changepassword',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('changepassword',[
                'model'=>$model
            ]);
        }
    }
}
