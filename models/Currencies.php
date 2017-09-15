<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property integer $CURRENCY_ID
 * @property string $CURRENCY_CODE
 * @property string $CURRENCY_SYM
 * @property integer $CY_RATE_VS_USD
 *
 * @property BudgetAvarage[] $budgetAvarages
 * @property CategoryPackage[] $categoryPackages
 * @property CommercialWeddingSponsor[] $commercialWeddingSponsors
 * @property Countries[] $countries
 * @property CountriesCurrencies[] $countriesCurrencies
 * @property FinacialCurrency[] $finacialCurrencies
 * @property FinacialCurrency[] $finacialCurrencies0
 * @property FinacialCurrency[] $finacialCurrencies1
 * @property FinacialCurrency[] $finacialCurrencies2
 * @property FinacialCurrency[] $finacialCurrencies3
 * @property FinacialCurrency[] $finacialCurrencies4
 * @property FinancialLoan[] $financialLoans
 * @property InvitationCardDesign[] $invitationCardDesigns
 * @property ItemOptionTrans[] $itemOptionTrans
 * @property Items[] $items
 * @property ItemsTrans[] $itemsTrans
 * @property PersonalContribution[] $personalContributions
 * @property PrivateSponsor[] $privateSponsors
 * @property Saving[] $savings
 * @property WeddingAccount[] $weddingAccounts
 * @property WeddingEstimatedBudget[] $weddingEstimatedBudgets
 * @property WeddingsInsurance[] $weddingsInsurances
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CY_RATE_VS_USD'], 'integer'],
            [['CURRENCY_CODE'], 'string', 'max' => 20],
            [['CURRENCY_SYM'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'CURRENCY_CODE' => Yii::t('app', 'Currency  Code'),
            'CURRENCY_SYM' => Yii::t('app', 'Currency  Sym'),
            'CY_RATE_VS_USD' => Yii::t('app', 'Cy  Rate  Vs  Usd'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetAvarages()
    {
        return $this->hasMany(BudgetAvarage::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPackages()
    {
        return $this->hasMany(CategoryPackage::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommercialWeddingSponsors()
    {
        return $this->hasMany(CommercialWeddingSponsor::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['DEFAULT_CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesCurrencies()
    {
        return $this->hasMany(CountriesCurrencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies()
    {
        return $this->hasMany(FinacialCurrency::className(), ['PRIVATE_SPONSOR_CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies0()
    {
        return $this->hasMany(FinacialCurrency::className(), ['COM_SPONSOR_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies1()
    {
        return $this->hasMany(FinacialCurrency::className(), ['LOAN_CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies2()
    {
        return $this->hasMany(FinacialCurrency::className(), ['SAVING_CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies3()
    {
        return $this->hasMany(FinacialCurrency::className(), ['PERSONAL_CONSTRIBUTIOM_CRY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinacialCurrencies4()
    {
        return $this->hasMany(FinacialCurrency::className(), ['WEDDING_ACCOUNT_CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancialLoans()
    {
        return $this->hasMany(FinancialLoan::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitationCardDesigns()
    {
        return $this->hasMany(InvitationCardDesign::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemOptionTrans()
    {
        return $this->hasMany(ItemOptionTrans::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsTrans()
    {
        return $this->hasMany(ItemsTrans::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalContributions()
    {
        return $this->hasMany(PersonalContribution::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivateSponsors()
    {
        return $this->hasMany(PrivateSponsor::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavings()
    {
        return $this->hasMany(Saving::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingAccounts()
    {
        return $this->hasMany(WeddingAccount::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEstimatedBudgets()
    {
        return $this->hasMany(WeddingEstimatedBudget::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingsInsurances()
    {
        return $this->hasMany(WeddingsInsurance::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }
}
