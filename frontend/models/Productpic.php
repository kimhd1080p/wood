<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productpic".
 *
 * @property int $picid
 * @property string $picname
 * @property int $products_pid
 *
 * @property Products $productsP
 */
class Productpic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productpic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_pid'], 'required'],
            [['products_pid'], 'integer'],
            [['picname'], 'string', 'max' => 45],
            [['products_pid'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['products_pid' => 'pid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'picid' => 'Picid',
            'picname' => 'Picname',
            'products_pid' => 'Products Pid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsP()
    {
        return $this->hasOne(Products::className(), ['pid' => 'products_pid']);
    }
}
