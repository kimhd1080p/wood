<?php


namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $u_name
 * @property string $u_surname
 * @property string $mobilephone
 * @property integer $type
 */
class UserPass extends ActiveRecord implements \yii\web\IdentityInterface
{
     
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'password_hash'], 'required'],
          
            [['password_hash'], 'string', 'max' => 256],
           
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัสบัตรประชาชน',
            'username' => 'บัญชีผู้ใช้',
            'auth_key' => 'Auth Key',
            'password_hash' => 'รหัสผ่าน',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'อีเมล',
            'status' => 'ใช้งาน',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'u_name' => 'ชื่อ-นามสกุล',
            'mobilephone' => 'เบอร์โทร',
            'type' => 'ตำแหน่ง',
        ];
    }
    
   
    

    public static function findIdentity($id) {
  

    return static::findOne($id); 
  
}

// public function getName()
// {
//     # code...
//     return $this->u_name;
// }

/**
 * @inheritdoc
 */
public static function findIdentityByAccessToken($token, $userType = null) {

    $user = self::find()
            ->where(["accessToken" => $token])
            ->one();
    if (!count($user)) {
        return null;
    }
    return new static($user);
}

/**
 * Finds user by username
 *
 * @param  string      $username
 * @return static|null
 */
public static function findByUsername($username) {
    $user = self::findOne(["email" => $username]);
           
    if (!count($user)) {
        return null;
    }
    return new static($user);
}

/**
 * @inheritdoc
 */
public function getId() {
    return $this->getPrimaryKey();
}

/**
 * @inheritdoc
 */
public function getAuthKey() {
    return $this->auth_key;
}

/**
 * @inheritdoc
 */
public function validateAuthKey($authKey) {
    return $this->auth_key === $authKey;
}

/**
 * Validates password
 *
 * @param  string  $password password to validate
 * @return boolean if password provided is valid for current user
 */
public function validatePassword($password) {
     return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
}
}
