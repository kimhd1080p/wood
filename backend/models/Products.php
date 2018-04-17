<?php

namespace backend\models;

use Yii;

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
 * @property int $pstatus
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
            [['pname', 'price', 'qty', 'typebuy_id', 'pic', 'typeproduct_tpid', 'unit', 'user_id'], 'required'],
            [['price'], 'number'],
            [['qty', 'typebuy_id', 'typeproduct_tpid', 'user_id', 'pstatus'], 'integer'],
            [['datetimeadd'], 'safe'],
            [['pname'], 'string', 'max' => 45],
            [['detials'], 'string', 'max' => 100],
             [['unit'], 'string', 'max' => 100],
            [['map'], 'string', 'max' => 255],
            [['pic'], 'string', 'max' => 256],
            [['typebuy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Typebuy::className(), 'targetAttribute' => ['typebuy_id' => 'tbid']],
            [['typeproduct_tpid'], 'exist', 'skipOnError' => true, 'targetClass' => Typeproduct::className(), 'targetAttribute' => ['typeproduct_tpid' => 'tpid']],
            //[['unit_uid'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_uid' => 'uid']],
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
            'datetimeadd' => 'วันที่',
            'detials' => 'รายละเอียด',
            'typebuy_id' => 'Typebuy ID',
            'map' => 'สถานที่ขาย',
            'pic' => 'รูปภาพ',
            'typeproduct_tpid' => 'Typeproduct Tpid',
            'unit' => 'หน่วย',
            'user_id' => 'User ID',
            'pstatus' => 'Pstatus',
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
    //0 ยังไม่มีคนซื้อ
    //1 มีคนซื้อแล้ว
      //2 ขายแล้วรอโอนเงิน
    //3 โอนเงินแล้ว
    //4 จัดส่งแล้ว
}
