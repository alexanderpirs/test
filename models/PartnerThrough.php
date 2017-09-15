<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner_through".
 *
 * @property integer $partner_through_id
 *
 * @property PartnerThroughTranslation[] $partnerThroughTranslations
 * @property SupplierPartnerThru[] $supplierPartnerThrus 
 */
class PartnerThrough extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_through';
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
            'partner_through_id' => Yii::t('app', 'Partner Through ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerThroughTranslations()
    {
        return $this->hasMany(PartnerThroughTranslation::className(), ['partner_through_id' => 'partner_through_id'])->where('LANGUAGE_ID = 1');
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
   public function getSupplierPartnerThrus()
   {
       return $this->hasMany(SupplierPartnerThru::className(), ['PARTNER_THRU_ID' => 'partner_through_id']);
   }
}
