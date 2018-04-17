<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "typebuy".
 *
 * @property int $tbid ID
 * @property string $tbname ประเภทการซื้อ
 *
 * @property Products[] $products
 */
class Typebuy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typebuy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tbname'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tbid' => 'ID',
            'tbname' => 'ประเภทการซื้อ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['typebuy_id' => 'tbid']);
    }
}
