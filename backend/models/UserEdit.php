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
class UserEdit extends \yii\db\ActiveRecord 
{
    public $amphures;
    public $provice;
    //public $zipcode;
     //public $passwordconfirm;
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
            [[ 'name', 'surname',], 'required'],
            [[ 'districts_DISTRICT_ID'], 'integer'],
              [['zipcode'], 'string', 'max' => 5],
     
            [['name', 'surname', 'address'], 'string', 'max' => 45],
            [['tel'], 'string', 'max' => 13],
          
            //[['amphures', 'provice', 'zipcode'], 'safe'],
           
            [['districts_DISTRICT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['districts_DISTRICT_ID' => 'DISTRICT_ID']],
            
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'เลขที่บัตรประจำตัวประชาชน',
            'email' => 'อีเมล',
            'auth_key' => 'Auth Key',
            'password_hash' => 'รหัสผ่าน',
            'passwordconfirm' => 'ยืนยันรหัสผ่าน',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
              'amphures' => 'อำเภอ/เขต',
            'provice' => 'จังหวัด',
            'zipcode' => 'รหัสไปรษณีย์',
            'tel' => 'เบอร์โทร',
            'districts_DISTRICT_ID' => 'ตำบล/แขวง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistrict()
    {
        return $this->hasOne(Districts::className(), ['DISTRICT_ID' => 'districts_DISTRICT_ID']);
    }
    
}
