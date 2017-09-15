<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_type".
 *
 * @property integer $BUSINESS_TYPE_ID
 *
 * @property BusinessTypeTranslation[] $businessTypeTranslations
 * @property SupplierBusinessType[] $supplierBusinessTypes
 */
class BusinessType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BUSINESS_TYPE_ID' => Yii::t('app', 'Business  Type  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessTypeTranslations()
    {
        return $this->hasMany(BusinessTypeTranslation::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID'])->where('LANGUAGE_ID = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierBusinessTypes()
    {
        return $this->hasMany(SupplierBusinessType::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']);
    }
}
