<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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
 * @property string $tambon ตำบล/แขวง
 * @property string $district อำเภอ/เขต
 * @property string $provice เพชรบูรณ์
 * @property string $postcode รหัสไปรษณีย์
 * @property string $tel เบอร์โทร
 *
 * @property Buy[] $buys
 * @property Products[] $products
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $passwordconfirm;
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
            [['id', 'email', 'password_hash', 'name', 'surname', 'tambon', 'district', 'provice', 'postcode', 'tel','passwordconfirm'], 'required'],
            [[ 'status', 'created_at', 'updated_at'], 'integer'],
            [['email'], 'string', 'max' => 100],
            //[['auth_key'], 'string', 'max' => 256],
            [['password_hash','passwordconfirm', 'password_reset_token'], 'string', 'max' => 256],
            [['name', 'surname', 'address', 'tambon', 'district', 'provice', 'postcode'], 'string', 'max' => 45],
            [['tel'], 'string', 'max' => 13],
            [['email'], 'unique'],
            [['id'], 'unique'],
             ['id', 'is13NumbersOnly'],
            ['password_hash','compare','compareAttribute'=>'passwordconfirm'],
            ['password_hash', 'paswordhash'],
            ['email', 'email'],
            ['email', 'filter', 'filter' => 'trim'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'เลขที่บัตรประจำตัวประชาชน',
            'email' => 'อีเมลหรือบัญชีผู้ใช้',
            //'auth_key' => 'Auth Key',
            'password_hash' => 'รหัสผ่าน',
            'passwordconfirm' => 'ยืนยันรหัสผ่าน',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'tambon' => 'ตำบล/แขวง',
            'district' => 'อำเภอ/เขต',
            'provice' => 'เพชรบูรณ์',
            'postcode' => 'รหัสไปรษณีย์',
            'tel' => 'เบอร์โทร',
        ];
    }
public function is13NumbersOnly($attribute)
{
    if (!preg_match('/^[0-9]{13}$/', $this->$attribute)) {
        $this->addError($attribute, 'กรุณาใส่ตัวเลข 13 หลัก');
        $this->password_hash=null;
        $this->passwordconfirm=null;
    }
}
public function paswordhash()
{
    $this->password_hash=Yii::$app->security->generatePasswordHash($this->password_hash);
    
}

 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuys()
    {
        return $this->hasMany(Buy::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['user_id' => 'id']);
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
}
