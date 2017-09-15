<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_business_type".
 *
 * @property integer $SUPPLIER_ID
 * @property integer $BUSINESS_TYPE_ID
 *
 * @property Suppliers $sUPPLIER
 * @property BusinessType $bUSINESSTYPE
 */
class SupplierBusinessType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_business_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BUSINESS_TYPE_ID'], 'integer'],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['BUSINESS_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessType::className(), 'targetAttribute' => ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'BUSINESS_TYPE_ID' => Yii::t('app', 'Business  Type  ID'),
        ];
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
    public function getBUSINESSTYPE()
    {
        return $this->hasOne(BusinessType::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']);
    }
}
