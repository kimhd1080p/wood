<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use backend\models\PasswordAdminForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
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

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
         
        $model = new Admin();

        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash=Yii::$app->security->generatePasswordHash($model->password_hash);
              $model->save();
            return $this->redirect(['view', 'id' => $model->username]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Admin model.
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
         
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
         if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
         
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
         if (Yii::$app->user->isGuest) {
             return $this->redirect(Yii::$app->user->loginUrl);
        }
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionChangepassword($username){
        
         if (Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->user->loginUrl);
        }
        $model = new PasswordAdminForm;
        $modeluser = Admin::find()->where([
            'username'=>$username
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
                    'model'=>$model,
                        'modeluser'=>$modeluser,
                ]);
            }
        }else{
            return $this->render('changepassword',[
                'model'=>$model,
                'modeluser'=>$modeluser,
                    
                    
            ]);
        }
    }
}
