<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coupons".
 *
 * @property integer $COUPON_ID
 * @property integer $ITEM_ID
 * @property integer $OPTION_ID
 * @property integer $SUPPLIER_ID
 * @property integer $WEDDING_ID
 * @property string $COUPON_GENERATED_DATE
 * @property string $EXPIRED_DATE
 * @property string $COUPON_FLAG
 *
 * @property ItemsSupplieirs $iTEM
 * @property ItemOptions $oPTION
 * @property Suppliers $sUPPLIER
 * @property Weddings $wEDDING
 */
class Coupons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'OPTION_ID', 'SUPPLIER_ID', 'WEDDING_ID'], 'integer'],
            [['COUPON_GENERATED_DATE', 'EXPIRED_DATE'], 'safe'],
            [['COUPON_FLAG'], 'string', 'max' => 1],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_SUPPLIER_ID']],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUPON_ID' => Yii::t('app', 'Coupon  ID'),
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'COUPON_GENERATED_DATE' => Yii::t('app', 'Coupon  Generated  Date'),
            'EXPIRED_DATE' => Yii::t('app', 'Expired  Date'),
            'COUPON_FLAG' => Yii::t('app', 'Coupon  Flag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
