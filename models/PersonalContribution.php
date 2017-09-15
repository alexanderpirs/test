<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personal_contribution".
 *
 * @property integer $PERSONAL_CONTRIBUTION_ID
 * @property string $PERSONAL_CONTRIBUTION_VALUE
 * @property integer $CURRENCY_ID
 * @property integer $WEDDING_ID
 * @property integer $RELATED_TO_ID
 *
 * @property Currencies $cURRENCY
 * @property CouplePartner $rELATEDTO
 * @property Weddings $wEDDING
 * @property SavingPersonalContribution[] $savingPersonalContributions
 */
class PersonalContribution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal_contribution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'PERSONAL_CONTRIBUTION_VALUE', 'RELATED_TO_ID'], 'required'],
            [['CURRENCY_ID', 'WEDDING_ID', 'RELATED_TO_ID'], 'integer'],
            [['PERSONAL_CONTRIBUTION_VALUE'], 'string', 'max' => 45],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['RELATED_TO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['RELATED_TO_ID' => 'COUPLE_PARTNER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PERSONAL_CONTRIBUTION_ID' => Yii::t('app', 'Personal  Contribution  ID'),
            'PERSONAL_CONTRIBUTION_VALUE' => Yii::t('app', 'Personal  Contribution  Value'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'RELATED_TO_ID' => Yii::t('app', 'Related  To  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELATEDTO()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'RELATED_TO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavingPersonalContributions()
    {
        return $this->hasMany(SavingPersonalContribution::className(), ['PERSONAL_CONTRIBUTION_ID' => 'PERSONAL_CONTRIBUTION_ID']);
    }
}
