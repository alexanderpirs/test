<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "add_to_cart".
 *
 * @property integer $ADD_TO_CART_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property integer $WEDDING_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property integer $QUANTITY
 * @property integer $OPTION_ID
 * @property string $ADD_TO_CART_DATE
 *
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property Weddings $wEDDING
 * @property CouplePartner $cOUPLEPARTNER
 * @property ItemOptions $oPTION
 */
class AddToCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_to_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'WEDDING_ID', 'COUPLE_PARTNER_ID', 'QUANTITY', 'OPTION_ID'], 'integer'],
            [['ADD_TO_CART_DATE'], 'safe'],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ADD_TO_CART_ID' => Yii::t('app', 'Add  To  Cart  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'QUANTITY' => Yii::t('app', 'Quantity'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'ADD_TO_CART_DATE' => Yii::t('app', 'Add  To  Cart  Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
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
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
    }
}
