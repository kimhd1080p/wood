<?php

namespace frontend\models;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "buy".
 *
 * @property int $bid เลขที่ใบสั่งซื้อ
 * @property double $pricein ราคาซื้อ
 * @property string $datetimeabuy วันที่ซื้อ
 * @property string $map สถานที่ส่ง
 * @property int $products_id สินค้า
 * @property int $userprofiles_id ผู้ชื้อ
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
    //public $zipcode;
       // public $checkbuy;
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
            [['pricein', 'products_id', 'user_id','amphures','provice','bqty'], 'required'],
            [['pricein','bqty'], 'number'],
            [['datetimeabuy'], 'safe'],
            [['products_id', 'status', 'user_id'], 'integer'],
            [['map'], 'string', 'max' => 45],
           // [['zipcode'], 'string', 'max' => 5],
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
            'map' => 'สถานที่ส่ง',
            'products_id' => 'สินค้า',
           'bqty' => 'จำนวน',
            'status' => 'สถานะ',
            'checkbuy' => 'สถานะ',
            'user_id' => 'ผู้ชื่อ',
                 'amphures' => 'อำเภอ/เขต',
            'provice' => 'จังหวัด',
            'datecheck' => 'หมดอายุ',
            //'zipcode' => 'รหัสไปรษณีย์',
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
    public function getDeliv()
    {
        return $this->hasOne(Delivery::className(), ['buy_bid' => 'bid']);
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
    public function getDatecheck()
    {
         $datecheck = date('Y-m-d', time() - (86400*7));
         if($this->datetimeabuy<$datecheck){
             return '-';
         }else{
              return date("Y-m-d",strtotime("+7 day"));
         }
         
    }
    
}
