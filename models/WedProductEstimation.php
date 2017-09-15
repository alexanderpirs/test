<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wed_product_estimation".
 *
 * @property integer $WED_PRODUCT_ESTIMATION
 * @property integer $PRODUCT_ID
 * @property string $ESTIMATED_VALUE
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_ID
 * @property integer $WEDDING_EVENT_ID
 * @property integer $SUB_CATEGORY_ID
 *
 * @property Products $pRODUCT
 * @property Currencies $cURRENCY
 * @property Weddings $wEDDING
 * @property WeddingEvent $wEDDINGEVENT
 * @property SubCategoriesOfItems $sUBCATEGORY
 */
class WedProductEstimation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wed_product_estimation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRODUCT_ID', 'CURRENCY_ID', 'ESTIMATED_VALUE' ], 'required'],
            [['PRODUCT_ID', 'CURRENCY_ID', 'WEDDING_ID', 'WEDDING_EVENT_ID', 'SUB_CATEGORY_ID'], 'integer'],
            [['ESTIMATED_VALUE'], 'string', 'max' => 45],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WED_PRODUCT_ESTIMATION' => Yii::t('app', 'Wed  Product  Estimation'),
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
            'ESTIMATED_VALUE' => Yii::t('app', 'Estimated  Value'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
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
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUBCATEGORY()
    {
        return $this->hasOne(SubCategoriesOfItems::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }
}
