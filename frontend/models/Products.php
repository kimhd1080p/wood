<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;
use frontend\models\Buy;
/**
 * This is the model class for table "products".
 *
 * @property int $pid รหัสสินค้า
 * @property string $pname ชื่อสินค้า
 * @property double $price ราคาขาย
 * @property int $qty จำนวน
 * @property string $datetimeadd วันที่
 * @property string $detials รายละเอียด
 * @property int $typebuy_id
 * @property string $map สถานที่ขาย
 * @property string $pic รูปภาพ
 * @property int $typeproduct_tpid
 * @property int $unit_uid
 * @property string $user_id
 *
 * @property Buy[] $buys
 * @property Productpic[] $productpics
 * @property Typebuy $typebuy
 * @property Typeproduct $typeproductTp
 * @property Unit $unitU
 * @property User $user
 */
class Products extends \yii\db\ActiveRecord
{
     
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pname', 'price', 'qty', 'typebuy_id', 'typeproduct_tpid', 'unit', 'user_id'], 'required'],
            [['price'], 'number'],
            [['qty', 'typebuy_id', 'typeproduct_tpid', 'user_id'], 'integer'],
            [['datetimeadd'], 'safe'],
            [['pname'], 'string', 'max' => 45],
             [['unit'], 'string', 'max' => 100],
            [['detials', 'pic'], 'string', 'max' => 256],
            [['map'], 'string', 'max' => 255],
            [['typebuy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Typebuy::className(), 'targetAttribute' => ['typebuy_id' => 'tbid']],
            [['typeproduct_tpid'], 'exist', 'skipOnError' => true, 'targetClass' => Typeproduct::className(), 'targetAttribute' => ['typeproduct_tpid' => 'tpid']],
           // [['unit_uid'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_uid' => 'uid']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pid' => 'รหัสสินค้า',
            'pname' => 'ชื่อสินค้า',
            'price' => 'ราคาขาย',
            'qty' => 'จำนวน',
            'datetimeadd' => 'วันที่ลงขาย',
              'user_id' => 'วันหมดอายุ',
            'detials' => 'รายละเอียด',
            'typebuy_id' => 'ประเภทการขาย',
            'map' => 'สถานที่ขาย',
            'pic' => 'รูปภาพ',
            'typeproduct_tpid' => 'ประเภท',
            'unit' => 'หน่วย',
            'user_id' => 'User ID',
            
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuys()
    {
        return $this->hasMany(Buy::className(), ['products_id' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductpics()
    {
        return $this->hasMany(Productpic::className(), ['products_pid' => 'pid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypebuy()
    {
        return $this->hasOne(Typebuy::className(), ['tbid' => 'typebuy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeproduct()
    {
        return $this->hasOne(Typeproduct::className(), ['tpid' => 'typeproduct_tpid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
      public function getPBcount()
    {
           $model = Buy::find()
    ->where(['!=', 'status', 0])->andWhere(['products_id' => $this->pid])
    ->count();
           
        return $model;
    }
//    public function getDatecheck()
//    {
//         $datecheck = date('Y-m-d', time() - (86400*7));
//         if($this->datetimeabuy<$datecheck){
//             return "หมดอายุ";
//         }else{
//              return date("Y-m-d",strtotime("+7 day"));
//         }
//         
//    }
   
    
  
}
