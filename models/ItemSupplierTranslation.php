<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_supplier_translation".
 *
 * @property integer $ITEM_SUPPLIER_ID
 * @property string $ITEM_DESCRIPTION
 * @property integer $LANGUAGE_ID
 *
 * @property Languages $lANGUAGE
 * @property ItemsSupplieirs $iTEMSUPPLIER
 */
class ItemSupplierTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_supplier_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'LANGUAGE_ID'], 'integer'],
            [['ITEM_DESCRIPTION'], 'string', 'max' => 4000],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'ITEM_DESCRIPTION' => Yii::t('app', 'Item  Description'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }
}
