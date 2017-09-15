<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner_through_translation".
 *
 * @property integer $partner_through_id
 * @property string $partner_through_value
 * @property integer $language_id
 *
 * @property PartnerThrough $partnerThrough
 * @property Languages $language
 */
class PartnerThroughTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner_through_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['partner_through_id', 'language_id'], 'integer'],
            [['partner_through_value'], 'string', 'max' => 100],
            [['partner_through_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartnerThrough::className(), 'targetAttribute' => ['partner_through_id' => 'partner_through_id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'partner_through_id' => Yii::t('app', 'Partner Through ID'),
            'partner_through_value' => Yii::t('app', 'Partner Through Value'),
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerThrough()
    {
        return $this->hasOne(PartnerThrough::className(), ['partner_through_id' => 'partner_through_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'language_id']);
    }
}
