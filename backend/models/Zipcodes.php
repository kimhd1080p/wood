<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "zipcodes".
 *
 * @property int $id
 * @property string $district_code
 * @property string $zipcode รหัสไปรษณีย์
 */
class Zipcodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
   
    public static function tableName()
    {
        return 'zipcodes';
    }
   

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'zipcode'], 'required'],
            [['district_code'], 'string', 'max' => 6],
            [['zipcode'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'district_code' => 'District Code',
            'zipcode' => 'รหัสไปรษณีย์',
             'zipcode1' => 'รหัสไปรษณีย์',
        ];
    }
      public function getZipcode1()
    {
        if(!$this->validate){
            return "ไม่ทราบ";
    }  
    }
      
     
}
