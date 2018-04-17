<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "districts".
 *
 * @property int $DISTRICT_ID
 * @property string $DISTRICT_CODE
 * @property string $DISTRICT_NAME ตำบล
 * @property string $DISTRICT_NAME_ENG
 * @property int $AMPHUR_ID
 * @property int $PROVINCE_ID
 * @property int $GEO_ID
 *
 * @property Delivery[] $deliveries
 * @property User[] $users
 */
class Districts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISTRICT_CODE', 'DISTRICT_NAME', 'DISTRICT_NAME_ENG'], 'required'],
            [['AMPHUR_ID', 'PROVINCE_ID', 'GEO_ID'], 'integer'],
            [['DISTRICT_CODE'], 'string', 'max' => 6],
            [['DISTRICT_NAME', 'DISTRICT_NAME_ENG'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DISTRICT_ID' => 'District  ID',
            'DISTRICT_CODE' => 'รหัสตำบล',
            'DISTRICT_NAME' => 'ตำบล',
            'DISTRICT_NAME_ENG' => 'District  Name  Eng',
            'AMPHUR_ID' => 'Amphur  ID',
            'PROVINCE_ID' => 'Province  ID',
            'GEO_ID' => 'Geo  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveries()
    {
        return $this->hasMany(Delivery::className(), ['districts_DISTRICT_ID' => 'DISTRICT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['districts_DISTRICT_ID' => 'DISTRICT_ID']);
    }
    public function getAmphure()
    {
        return $this->hasOne(Amphures::className(), ['AMPHUR_ID' => 'AMPHUR_ID']);
    }
    public function getZipcode()
    {
        return $this->hasOne(Zipcodes::className(), ['district_code' => 'DISTRICT_CODE']);
    }
}
