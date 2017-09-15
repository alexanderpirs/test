<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $LANGUAGE_ID
 * @property string $LANGUAGE_NAME
 * @property string $LANGUAGE_DESC
 * @property string $DIRECTION
 *
 * @property Agenda[] $agendas
 * @property AgendaPeriodeTranslation[] $agendaPeriodeTranslations
 * @property AgendaTipsTrans[] $agendaTipsTrans
 * @property AgendaTranslation[] $agendaTranslations
 * @property CategoryOfItemsTrans[] $categoryOfItemsTrans
 * @property CategoryPackageTrans[] $categoryPackageTrans
 * @property Countries[] $countries
 * @property Countries[] $countries0
 * @property CountriesTrans[] $countriesTrans
 * @property GenderTranslation[] $genderTranslations
 * @property Genders[] $genders
 * @property Horoscope[] $horoscopes
 * @property HoroscopeInfo[] $horoscopeInfos
 * @property HtmlComponents[] $htmlComponents
 * @property InviteeRelationTypes[] $inviteeRelationTypes
 * @property InviteesRelationTypeTrans[] $inviteesRelationTypeTrans
 * @property ItemSupplierTranslation[] $itemSupplierTranslations
 * @property ItemsTrans[] $itemsTrans
 * @property MaritalStatus[] $maritalStatuses
 * @property Products[] $products
 * @property ProductsTrans[] $productsTrans
 * @property SendCartByTrans[] $sendCartByTrans
 * @property SubCategoriesTrans[] $subCategoriesTrans
 * @property SuplierTypeTrans[] $suplierTypeTrans
 * @property SupplierTypes[] $supplierTypes
 * @property SupportTypeTrans[] $supportTypeTrans
 * @property WeddingEventTranslation[] $weddingEventTranslations
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_NAME', 'DIRECTION'], 'string', 'max' => 5],
            [['LANGUAGE_DESC'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
            'LANGUAGE_NAME' => Yii::t('app', 'Language  Name'),
            'LANGUAGE_DESC' => Yii::t('app', 'Language  Desc'),
            'DIRECTION' => Yii::t('app', 'Direction'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaPeriodeTranslations()
    {
        return $this->hasMany(AgendaPeriodeTranslation::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaTipsTrans()
    {
        return $this->hasMany(AgendaTipsTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaTranslations()
    {
        return $this->hasMany(AgendaTranslation::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOfItemsTrans()
    {
        return $this->hasMany(CategoryOfItemsTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryPackageTrans()
    {
        return $this->hasMany(CategoryPackageTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Countries::className(), ['DEFAULT_LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries0()
    {
        return $this->hasMany(Countries::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesTrans()
    {
        return $this->hasMany(CountriesTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenderTranslations()
    {
        return $this->hasMany(GenderTranslation::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenders()
    {
        return $this->hasMany(Genders::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoroscopes()
    {
        return $this->hasMany(Horoscope::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHoroscopeInfos()
    {
        return $this->hasMany(HoroscopeInfo::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHtmlComponents()
    {
        return $this->hasMany(HtmlComponents::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteeRelationTypes()
    {
        return $this->hasMany(InviteeRelationTypes::className(), ['LANGUAGES_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInviteesRelationTypeTrans()
    {
        return $this->hasMany(InviteesRelationTypeTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSupplierTranslations()
    {
        return $this->hasMany(ItemSupplierTranslation::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsTrans()
    {
        return $this->hasMany(ItemsTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaritalStatuses()
    {
        return $this->hasMany(MaritalStatus::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsTrans()
    {
        return $this->hasMany(ProductsTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSendCartByTrans()
    {
        return $this->hasMany(SendCartByTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesTrans()
    {
        return $this->hasMany(SubCategoriesTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuplierTypeTrans()
    {
        return $this->hasMany(SuplierTypeTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplierTypes()
    {
        return $this->hasMany(SupplierTypes::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportTypeTrans()
    {
        return $this->hasMany(SupportTypeTrans::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingEventTranslations()
    {
        return $this->hasMany(WeddingEventTranslation::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
