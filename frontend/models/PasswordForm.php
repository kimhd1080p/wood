<?php 
namespace frontend\models;

    
    use Yii;
    use yii\base\Model;
    use frontend\models\User;
    
    class PasswordForm extends Model{
        public $oldpass;
        public $newpass;
        public $repeatnewpass;
        
        public function rules(){
            return [
                [['oldpass','newpass','repeatnewpass'],'required'],
                ['oldpass','findPasswords'],
                ['repeatnewpass','compare','compareAttribute'=>'newpass'],
            ];
        }
        
        public function findPasswords($attribute, $params){
            $user = User::find()->where([
                'email'=>Yii::$app->user->identity->email
            ])->one();
          
          $password = Yii::$app->getSecurity()->validatePassword($this->oldpass, $user->password_hash);
            if($password!=$this->oldpass)
                $this->addError($attribute,'Old password is incorrect');
        }
        
        public function attributeLabels(){
            return [
                'oldpass'=>'รหัสผ่านเดิม',
                'newpass'=>'รหัสผ่านใหม่',
                'repeatnewpass'=>'ยืนยันรหัสผ่านใหม่',
            ];
        }
    }