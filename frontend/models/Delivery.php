<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $buy_bid
 * @property string $address ที่อยู่
 * @property int $districts_DISTRICT_ID ตำบล
 * @property string $tel เบอร์โทร
 *
 * @property Buy $buyB
 * @property Districts $districtsDISTRICT
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buy_bid', 'districts_DISTRICT_ID','tel','zipcode'], 'required'],
            [['buy_bid', 'districts_DISTRICT_ID'], 'integer'],
            [['address'], 'string', 'max' => 100],
             [[ 'tel'], 'string', 'max' => 13],
            [['buy_bid'], 'unique'],
            [['zipcode'], 'string', 'max' => 5],
            [['buy_bid'], 'exist', 'skipOnError' => true, 'targetClass' => Buy::className(), 'targetAttribute' => ['buy_bid' => 'bid']],
            [['districts_DISTRICT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Districts::className(), 'targetAttribute' => ['districts_DISTRICT_ID' => 'DISTRICT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buy_bid' => 'Buy Bid',
            'address' => 'ที่อยู่',
            'districts_DISTRICT_ID' => 'ตำบล',
            'tel' => 'เบอร์โทร',
            'zipcode' => 'รหัสไปรษณีย์',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyB()
    {
        return $this->hasOne(Buy::className(), ['bid' => 'buy_bid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistricts()
    {
        return $this->hasOne(Districts::className(), ['DISTRICT_ID' => 'districts_DISTRICT_ID']);
    }
}
