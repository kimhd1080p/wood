<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
/**
/**
 * This is the model class for table "user".
 *
 * @property string $id เลขที่บัตรประจำตัวประชาชน
 * @property string $email อีเมลหรือบัญชีผู้ใช้
 * @property string $auth_key
 * @property string $password_hash รหัสผ่าน
 * @property string $password_reset_token
 * @property int $status Status
 * @property int $created_at
 * @property int $updated_at
 * @property string $name ชื่อ
 * @property string $surname นามสกุล
 * @property string $address ที่อยู่
 * @property string $tel เบอร์โทร
 * @property int $districts_DISTRICT_ID
 *
 * @property Buy[] $buys
 * @property Products[] $products
 * @property Districts $districtsDISTRICT
 */
class Admin extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $amphures;
    public $provice;
    //public $zipcode;
     public $passwordconfirm;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }
    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['username', 'password_hash', 'u_name'], 'required'],
            [['username'], 'unique'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            //[['id'], 'integer', 'min' => 13],
             //[['id'], 'integer', 'max' => 14],
       
            ['email', 'email'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 256],
            [['u_name'], 'string', 'max' => 70],
            [['mobilephone'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            
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
        
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    
  
public function paswordhash()
{
    $this->password_hash=Yii::$app->security->generatePasswordHash($this->password_hash);
    
}

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
    $user = self::findOne(["username" => $username]);
           
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


/**
 * Validates password
 *
 * @param  string  $password password to validate
 * @return boolean if password provided is valid for current user
 */
public function validatePassword($password) {
     return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
}

public function behaviors() 
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ],
                'value' => new Expression('NOW()'),
            ],
        ]; 
    }
    
     public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public static function findByPasswordResetToken($token)
    {
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }
    public static function findIdentity($id) {
  

    return static::findOne($id); 
  
}
}
