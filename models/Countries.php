<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $COUNTRY_ID
 * @property string $COUNTRY_NAME
 * @property integer $LANGUAGE_ID
 * @property integer $DEFAULT_CURRENCY_ID
 * @property integer $DEFAULT_LANGUAGE_ID
 *
 * @property Agenda[] $agendas
 * @property AgendaCountries[] $agendaCountries
 * @property BudgetAvarage[] $budgetAvarages
 * @property CategoriesCountries[] $categoriesCountries
 * @property CategoryOfItemCtryWedType[] $categoryOfItemCtryWedTypes
 * @property Currencies $dEFAULTCURRENCY
 * @property Languages $dEFAULTLANGUAGE
 * @property Languages $lANGUAGE
 * @property CountriesCurrencies[] $countriesCurrencies
 * @property CountriesTrans[] $countriesTrans
 * @property ItemsCountries[] $itemsCountries
 * @property ProductsCountries[] $productsCountries
 * @property SponsorsCountries[] $sponsorsCountries
 * @property SubCategoriesCountries[] $subCategoriesCountries
 * @property Suppliers[] $suppliers
 * @property Weddings[] $weddings
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LANGUAGE_ID', 'DEFAULT_CURRENCY_ID', 'DEFAULT_LANGUAGE_ID'], 'integer'],
            [['COUNTRY_NAME'], 'string', 'max' => 30],
            [['DEFAULT_CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['DEFAULT_CURRENCY_ID' => 'CURRENCY_ID']],
            [['DEFAULT_LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['DEFAULT_LANGUAGE_ID' => 'LANGUAGE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
            'COUNTRY_NAME' => Yii::t('app', 'Country  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
            'DEFAULT_CURRENCY_ID' => Yii::t('app', 'Default  Currency  ID'),
            'DEFAULT_LANGUAGE_ID' => Yii::t('app', 'Default  Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaCountries()
    {
        return $this->hasMany(AgendaCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudgetAvarages()
    {
        return $this->hasMany(BudgetAvarage::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesCountries()
    {
        return $this->hasMany(CategoriesCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOfItemCtryWedTypes()
    {
        return $this->hasMany(CategoryOfItemCtryWedType::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEFAULTCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'DEFAULT_CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDEFAULTLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'DEFAULT_LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesCurrencies()
    {
        return $this->hasMany(CountriesCurrencies::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountriesTrans()
    {
        return $this->hasMany(CountriesTrans::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsCountries()
    {
        return $this->hasMany(ItemsCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCountries()
    {
        return $this->hasMany(ProductsCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorsCountries()
    {
        return $this->hasMany(SponsorsCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesCountries()
    {
        return $this->hasMany(SubCategoriesCountries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddings()
    {
        return $this->hasMany(Weddings::className(), ['WEDDING_COUNTRY_ID' => 'COUNTRY_ID']);
    }
}
