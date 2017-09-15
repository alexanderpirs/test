<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commercial_wedding_sponsor".
 *
 * @property integer $SPONSOR_ID
 * @property integer $WEDDING_ID
 * @property integer $COMMERCIAL_WEDDING_SPONSOR_ID
 * @property string $AMOUNT
 * @property integer $CURRENCY_ID
 * @property string $COMMERCIAL_SPONSOR_NAME
 *
 * @property Currencies $cURRENCY
 * @property Sponsors $sPONSOR
 * @property Weddings $wEDDING
 * @property SavingCommercialSponsor[] $savingCommercialSponsors
 */
class CommercialWeddingSponsor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commercial_wedding_sponsor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SPONSOR_ID', 'WEDDING_ID', 'CURRENCY_ID'], 'integer'],
            [['AMOUNT'], 'string', 'max' => 20],
            [['COMMERCIAL_SPONSOR_NAME'], 'string', 'max' => 50],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['SPONSOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsors::className(), 'targetAttribute' => ['SPONSOR_ID' => 'SPONSOR_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SPONSOR_ID' => Yii::t('app', 'Sponsor  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'COMMERCIAL_WEDDING_SPONSOR_ID' => Yii::t('app', 'Commercial  Wedding  Sponsor  ID'),
            'AMOUNT' => Yii::t('app', 'Amount'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'COMMERCIAL_SPONSOR_NAME' => Yii::t('app', 'Commercial  Sponsor  Name'),
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
    public function getSPONSOR()
    {
        return $this->hasOne(Sponsors::className(), ['SPONSOR_ID' => 'SPONSOR_ID']);
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
    public function getSavingCommercialSponsors()
    {
        return $this->hasMany(SavingCommercialSponsor::className(), ['COMMERCIAL_SPONSOR_ID' => 'COMMERCIAL_WEDDING_SPONSOR_ID']);
    }
}
