<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_partner_thru".
 *
 * @property integer $SUPPLIER_ID
 * @property integer $PARTNER_THRU_ID
 *
 * @property Suppliers $sUPPLIER
 * @property PartnerThrough $pARTNERTHRU
 */
class SupplierPartnerThru extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_partner_thru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_ID', 'PARTNER_THRU_ID'], 'integer'],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['PARTNER_THRU_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PartnerThrough::className(), 'targetAttribute' => ['PARTNER_THRU_ID' => 'partner_through_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'PARTNER_THRU_ID' => Yii::t('app', 'Partner  Thru  ID'),
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
    public function getPARTNERTHRU()
    {
        return $this->hasOne(PartnerThrough::className(), ['partner_through_id' => 'PARTNER_THRU_ID']);
    }
}
