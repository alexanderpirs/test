<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "criteria_values".
 *
 * @property integer $CRITERIA_VALUE_ID
 * @property integer $CRITERIA_ID
 * @property string $CRITERIA_VALUE
 * @property integer $ITEM_SUPPLIER_ID
 *
 * @property Criterias $cRITERIA
 * @property ItemsSupplieirs $iTEMSUPPLIER
 */
class CriteriaValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'criteria_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CRITERIA_ID', 'ITEM_SUPPLIER_ID'], 'integer'],
            [['CRITERIA_VALUE'], 'string', 'max' => 45],
            [['CRITERIA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Criterias::className(), 'targetAttribute' => ['CRITERIA_ID' => 'CRITERIA_ID']],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CRITERIA_VALUE_ID' => Yii::t('app', 'Criteria  Value  ID'),
            'CRITERIA_ID' => Yii::t('app', 'Criteria  ID'),
            'CRITERIA_VALUE' => Yii::t('app', 'Criteria  Value'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCRITERIA()
    {
        return $this->hasOne(Criterias::className(), ['CRITERIA_ID' => 'CRITERIA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }
}
