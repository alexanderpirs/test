<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weddings".
 *
 * @property integer $WEDDING_ID
 * @property integer $FIRST_COUPLE_PARTNER_ID
 * @property integer $SECOND_COUPLE_PARTNER_ID
 * @property integer $WEDDING_TYPE_ID
 * @property integer $WEDDING_COUNTRY_ID
 * @property string $COUPLE_IMG
 *
 * @property CommercialWeddingSponsor[] $commercialWeddingSponsors
 * @property FinacialCurrency[] $finacialCurrencies
 * @property FinancialLoan[] $financialLoans
 * @property Invitees[] $invitees
 * @property ItemsCard[] $itemsCards
 * @property PersonalContribution[] $personalContributions
 * @property PrivateSponsor[] $privateSponsors
 * @property Saving[] $savings
 * @property WedCategoryEstimatedBudget[] $wedCategoryEstimatedBudgets
 * @property WeddingAccount[] $weddingAccounts
 * @property WeddingAgendaTasks[] $weddingAgendaTasks
 * @property WeddingEstimatedBudget[] $weddingEstimatedBudgets
 * @property WeddingEvent[] $weddingEvents
 * @property WeddingInvitationCards[] $weddingInvitationCards
 * @property WeddingRealBudget[] $weddingRealBudgets
 * @property WeddingTentativePeriodes[] $weddingTentativePeriodes
 * @property Countries $wEDDINGCOUNTRY
 * @property WeddingType $wEDDINGTYPE
 * @property CouplePartner $sECONDCOUPLEPARTNER
 * @property CouplePartner $fIRSTCOUPLEPARTNER
 * @property WeddingsInsurance[] $weddingsInsurances
 */
class Weddings extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weddings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FIRST_COUPLE_PARTNER_ID', 'SECOND_COUPLE_PARTNER_ID', 'WEDDING_TYPE_ID', 'WEDDING_COUNTRY_ID'], 'integer'],
            [['COUPLE_IMG'], 'string', 'max' => 200],
            [['WEDDING_COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['WEDDING_COUNTRY_ID' => 'COUNTRY_ID']],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
            [['SECOND_COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['SECOND_COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['FIRST_COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['FIRST_COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'FIRST_COUPLE_PARTNER_ID' => Yii::t('app', 'First  Couple  Partner  ID'),
            'SECOND_COUPLE_PARTNER_ID' => Yii::t('app', 'Second  Couple  Partner  ID'),
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type'),
            'WEDDING_COUNTRY_ID' => Yii::t('app', 'Wedding  Country'),
            'COUPLE_IMG' => Yii::t('app', 'Couple Img'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommercialWeddingSponsors()
    {
        return $this->hasMany(CommercialWeddingSponsor::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
    
public function upload()
    {
//    Yii::error("imagessssssssss  : ".$this->imageFile);
//            echo $this->imageFile;
            Yii::error( Yii::$app->basePath.'/wedding-uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            
//        if ($this->validate()) {
            $this->imageFile->saveAs(Yii::$app->basePath.'/web/wedding-uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return '/wedding-uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
//        } else {
//            return false;
//        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies()
    {
        return $this->hasMany(FinacialCurrency::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialLoans()
    {
        return $this->hasMany(FinancialLoan::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitees()
    {
        return $this->hasMany(Invitees::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsCards()
    {
        return $this->hasMany(ItemsCard::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalContributions()
    {
        return $this->hasMany(PersonalContribution::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateSponsors()
    {
        return $this->hasMany(PrivateSponsor::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWedCategoryEstimatedBudgets()
    {
        return $this->hasMany(WedCategoryEstimatedBudget::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAccounts()
    {
        return $this->hasMany(WeddingAccount::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAgendaTasks()
    {
        return $this->hasMany(WeddingAgendaTasks::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEstimatedBudgets()
    {
        return $this->hasMany(WeddingEstimatedBudget::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEvents()
    {
        return $this->hasMany(WeddingEvent::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingInvitationCards()
    {
        return $this->hasMany(WeddingInvitationCards::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingRealBudgets()
    {
        return $this->hasMany(WeddingRealBudget::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingTentativePeriodes()
    {
        return $this->hasMany(WeddingTentativePeriodes::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'WEDDING_COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSECONDCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'SECOND_COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFIRSTCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'FIRST_COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingsInsurances()
    {
        return $this->hasMany(WeddingsInsurance::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
