<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coupon_counter".
 *
 * @property integer $COUPON_COUNTER_ID
 * @property integer $COUPON_COUNTER_NUMBER
 * @property integer $PRODUCT_ID
 * @property integer $WEDDING_ID
 *
 * @property Products $pRODUCT
 * @property Weddings $wEDDING
 */
class CouponCounter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUPON_COUNTER_NUMBER', 'PRODUCT_ID', 'WEDDING_ID'], 'integer'],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUPON_COUNTER_ID' => Yii::t('app', 'Coupon  Counter  ID'),
            'COUPON_COUNTER_NUMBER' => Yii::t('app', 'Coupon  Counter  Number'),
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
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
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
