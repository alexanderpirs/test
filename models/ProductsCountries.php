<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products_countries".
 *
 * @property integer $PRODUCT_ID
 * @property integer $COUNTRY_ID
 *
 * @property Products $pRODUCT
 * @property Countries $cOUNTRY
 */
class ProductsCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'COUNTRY_ID'], 'integer'],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRODUCT()
    {
        return $this->hasOne(Products::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }
}
