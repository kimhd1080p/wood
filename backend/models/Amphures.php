<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "amphures".
 *
 * @property int $AMPHUR_ID
 * @property string $AMPHUR_CODE
 * @property string $AMPHUR_NAME อำเภอ
 * @property string $AMPHUR_NAME_ENG
 * @property int $GEO_ID
 * @property int $PROVINCE_ID
 */
class Amphures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amphures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AMPHUR_CODE', 'AMPHUR_NAME', 'AMPHUR_NAME_ENG'], 'required'],
            [['GEO_ID', 'PROVINCE_ID'], 'integer'],
            [['AMPHUR_CODE'], 'string', 'max' => 4],
            [['AMPHUR_NAME', 'AMPHUR_NAME_ENG'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AMPHUR_ID' => 'Amphur  ID',
            'AMPHUR_CODE' => 'Amphur  Code',
            'AMPHUR_NAME' => 'อำเภอ',
            'AMPHUR_NAME_ENG' => 'Amphur  Name  Eng',
            'GEO_ID' => 'Geo  ID',
            'PROVINCE_ID' => 'Province  ID',
        ];
    }
     public function getProvince()
    {
        return $this->hasOne(Provinces::className(), ['PROVINCE_ID' => 'PROVINCE_ID']);
    }
}
