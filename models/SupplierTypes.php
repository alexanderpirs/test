<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_types".
 *
 * @property integer $SUPPLIER_TYPE_ID
 * @property string $SUPPLIER_TYPE_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property ProductSupplierTye[] $productSupplierTyes
 * @property SuplierTypeTrans[] $suplierTypeTrans
 * @property Languages $lANGUAGE
 * @property Suppliers[] $suppliers
 */
class SupplierTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_ID'], 'integer'],
            [['SUPPLIER_TYPE_NAME'], 'string', 'max' => 30],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_TYPE_ID' => Yii::t('app', 'Supplier  Type  ID'),
            'SUPPLIER_TYPE_NAME' => Yii::t('app', 'Supplier  Type  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierTyes()
    {
        return $this->hasMany(ProductSupplierTye::className(), ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuplierTypeTrans()
    {
        return $this->hasMany(SuplierTypeTrans::className(), ['SUPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']);
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
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']);
    }
}
