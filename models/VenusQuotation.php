<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "venus_quotation".
 *
 * @property integer $VENU_QUOTATION_ID
 * @property integer $WEDDING_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property string $FROM_DATE
 * @property string $TO_DATE
 * @property integer $COUNTRY_ID
 * @property integer $CITY_ID
 * @property resource $NOTE
 * @property string $MIN_PRICE
 * @property string $MAX_PRICE
 * @property integer $CURRENCY_ID
 *
 * @property Weddings $wEDDING
 * @property CouplePartner $cOUPLEPARTNER
 * @property Countries $cOUNTRY
 * @property Cities $cITY
 * @property Currencies $cURRENCY
 */
class VenusQuotation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venus_quotation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'COUPLE_PARTNER_ID', 'COUNTRY_ID', 'CITY_ID', 'CURRENCY_ID'], 'integer'],
            [['FROM_DATE', 'TO_DATE'], 'safe'],
            [['NOTE'], 'string'],
            [['MIN_PRICE', 'MAX_PRICE'], 'string', 'max' => 45],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
            [['CITY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['CITY_ID' => 'CITY_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VENU_QUOTATION_ID' => Yii::t('app', 'Venu  Quotation  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'FROM_DATE' => Yii::t('app', 'From  Date'),
            'TO_DATE' => Yii::t('app', 'To  Date'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
            'CITY_ID' => Yii::t('app', 'City  ID'),
            'NOTE' => Yii::t('app', 'Note'),
            'MIN_PRICE' => Yii::t('app', 'Min  Price'),
            'MAX_PRICE' => Yii::t('app', 'Max  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
        ];
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
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCITY()
    {
        return $this->hasOne(Cities::className(), ['CITY_ID' => 'CITY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }
}
