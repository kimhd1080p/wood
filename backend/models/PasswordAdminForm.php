<?php 
namespace backend\models;

    
    use Yii;
    use yii\base\Model;

    
    class PasswordAdminForm extends Model{
       
        public $newpass;
        public $repeatnewpass;
        
        public function rules(){
            return [
                [['newpass','repeatnewpass'],'required'],
          
                ['repeatnewpass','compare','compareAttribute'=>'newpass'],
            ];
        }
        
        
        
        public function attributeLabels(){
            return [
                
                'newpass'=>'รหัสผ่านใหม่',
                'repeatnewpass'=>'ยืนยันรหัสผ่านใหม่',
            ];
        }
    }