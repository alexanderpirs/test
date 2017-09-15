<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registry_selected_items".
 *
 * @property integer $REGISTRY_SELECTED_ITEMS_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property integer $OPTION_ID
 * @property integer $WEDDING_ID
 * @property integer $PRODUCT_ID
 *
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property ItemOptions $oPTION
 * @property Weddings $wEDDING
 * @property Products $pRODUCT
 */
class RegistrySelectedItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registry_selected_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'OPTION_ID', 'WEDDING_ID', 'PRODUCT_ID'], 'integer'],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['PRODUCT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['PRODUCT_ID' => 'PRODUCT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REGISTRY_SELECTED_ITEMS_ID' => Yii::t('app', 'Registry  Selected  Items  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'PRODUCT_ID' => Yii::t('app', 'Product  ID'),
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
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
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
    public function getPRODUCT()
    {
        return $this->hasOne(Products::className(), ['PRODUCT_ID' => 'PRODUCT_ID']);
    }
}
