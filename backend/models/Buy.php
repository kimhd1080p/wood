<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "buy".
 *
 * @property int $bid เลขที่ใบสั่งซื้อ
 * @property double $pricein ราคาซื้อ
 * @property string $datetimeabuy วันที่ซื้อ
 * @property string $map สถานที่ส่ง
 * @property int $products_id สินค้า
 * @property int $status สถานะ
 * @property string $user_id
 *
 * @property Products $products
 * @property User $user
 */
class Buy extends \yii\db\ActiveRecord
{
      public $amphures;
    public $provice;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pricein', 'products_id', 'user_id','bqty'], 'required'],
            [['pricein','bqty'], 'number'],
            [['datetimeabuy'], 'safe'],
            [['products_id', 'status', 'user_id'], 'integer'],
            [['map'], 'string', 'max' => 45],
            [['products_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['products_id' => 'pid']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bid' => 'เลขที่ใบสั่งซื้อ',
            'pricein' => 'ราคาซื้อ',
            'datetimeabuy' => 'วันที่ซื้อ',
                'bqty' => 'จำนวนซื้อ',
            'map' => 'สถานที่ส่ง',
            'products_id' => 'สินค้า',
            'status' => 'สถานะ',
            'user_id' => 'ลูกค้า',
            'name' => 'ชื่อลูกค้า',
                   'amphures' => 'อำเภอ/เขต',
            'provice' => 'จังหวัด',
            'datecheck' => 'หมดอายุ',
             'transfercheck' => 'แจ้งโอนเงิน',
            'delicheck' => 'จัดส่ง',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['pid' => 'products_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getCheckbuy()
    {
         // 0 รอติดต่อกลับ
         // 1 รอโอนเงิน
         // 2 ชำระเงินแล้ว
         // 3 จัดส่งแล้ว
        if($this->user_id==Yii::$app->user->identity->id&&$this->status==0){
            //$checkbuy= "รอติดต่อกลับ";
            return "รอติดต่อกลับ";
        }
        else if($this->user_id==Yii::$app->user->identity->id&&$this->status==1){
             //$checkbuy= "รอโอนเงิน";
              return "รอโอนเงิน";
        }
        else if($this->user_id==Yii::$app->user->identity->id&&$this->status==2){
            // $checkbuy= "จัดส่งแล้ว";
              return "ชำระเงินแล้ว";
        }
         else if($this->user_id==Yii::$app->user->identity->id&&$this->status==3){
            // $checkbuy= "จัดส่งแล้ว";
              return "จัดส่งแล้ว";
        }else{
            //$checkbuy= "ถูกขายไปแล้ว";
             return "ไม่ทราบ";
        }
    }
    public function getDeliv()
    {
        return $this->hasOne(Delivery::className(), ['buy_bid' => 'bid']);
    }
    public function getDatecheck()
    {
         $datecheck = date('Y-m-d', time() - (86400*7));
         if($this->datetimeabuy<$datecheck){
             return 0;
         }else{
              return $this->add_date($this->datetimeabuy,7,0,0);
         }
         
    }
    
    protected function add_date($givendate,$day=0,$mth=0,$yr=0) {
$cd = strtotime($givendate);
$newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
date('d',$cd)+$day, date('Y',$cd)+$yr));
return $newdate;
}


    public function getTransfercheck()
    {
         
         if($this->status===1){
             return 0;
         }else{
              return "ชำระเงินแล้ว";
         }
         
    }
    public function getDelicheck()
    {
         
         if($this->status===2){
             return 0;
         }else{
              return "จัดส่งแล้ว";
         }
         
    }
}
