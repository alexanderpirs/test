<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "business_type_translation".
 *
 * @property integer $BUSINESS_TYPE_ID
 * @property string $BUSINESS_TYPE_VALUE
 * @property integer $LANGUAGE_ID
 *
 * @property BusinessType $bUSINESSTYPE
 * @property Languages $lANGUAGE
 */
class BusinessTypeTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'business_type_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BUSINESS_TYPE_ID', 'LANGUAGE_ID'], 'integer'],
            [['BUSINESS_TYPE_VALUE'], 'string', 'max' => 45],
            [['BUSINESS_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessType::className(), 'targetAttribute' => ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BUSINESS_TYPE_ID' => Yii::t('app', 'Business  Type  ID'),
            'BUSINESS_TYPE_VALUE' => Yii::t('app', 'Business  Type  Value'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBUSINESSTYPE()
    {
        return $this->hasOne(BusinessType::className(), ['BUSINESS_TYPE_ID' => 'BUSINESS_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
