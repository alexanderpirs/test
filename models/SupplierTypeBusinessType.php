<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_type_business_type".
 *
 * @property integer $SUPPLIER_TYPE_ID
 * @property integer $BUSINESS_TYPE_ID
 *
 * @property SupplierTypes $sUPPLIERTYPE
 * @property BusinessType $bUSINESSTYPE
 */
class SupplierTypeBusinessType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_type_business_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_TYPE_ID', 'BUSINESS_TYPE_ID'], 'integer'],
            [['SUPPLIER_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierTypes::className(), 'targetAttribute' => ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']],
            [['BUSINESS_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessType::className(), 'targetAttribute' => ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_TYPE_ID' => Yii::t('app', 'Supplier  Type  ID'),
            'BUSINESS_TYPE_ID' => Yii::t('app', 'Business  Type  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIERTYPE()
    {
        return $this->hasOne(SupplierTypes::className(), ['SUPPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBUSINESSTYPE()
    {
        return $this->hasOne(BusinessType::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']);
    }
}
