<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "typeproduct".
 *
 * @property int $tpid
 * @property string $tpname ประเภท
 *
 * @property Products[] $products
 */
class Typeproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'typeproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tpname'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tpid' => 'ID',
            'tpname' => 'ประเภท',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['typeproduct_tpid' => 'tpid']);
    }
}
