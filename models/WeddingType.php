<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_type".
 *
 * @property integer $WEDDING_TYPE_ID
 * @property string $WEDDING_TYPE_NAME
 *
 * @property AdsWeddingType[] $adsWeddingTypes
 * @property Agenda[] $agendas
 * @property AgendaWeddingType[] $agendaWeddingTypes
 * @property CategoriesWeddingType[] $categoriesWeddingTypes
 * @property CategoryOfItemCtryWedType[] $categoryOfItemCtryWedTypes
 * @property ItemsWeddingType[] $itemsWeddingTypes
 * @property ProductWeddingType[] $productWeddingTypes
 * @property SubCategoriesWeddingType[] $subCategoriesWeddingTypes
 * @property WeddingTypeTranslation $weddingTypeTranslation
 * @property Weddings[] $weddings
 */
class WeddingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_TYPE_NAME'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
            'WEDDING_TYPE_NAME' => Yii::t('app', 'Wedding  Type  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdsWeddingTypes()
    {
        return $this->hasMany(AdsWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgendaWeddingTypes()
    {
        return $this->hasMany(AgendaWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesWeddingTypes()
    {
        return $this->hasMany(CategoriesWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryOfItemCtryWedTypes()
    {
        return $this->hasMany(CategoryOfItemCtryWedType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemsWeddingTypes()
    {
        return $this->hasMany(ItemsWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductWeddingTypes()
    {
        return $this->hasMany(ProductWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategoriesWeddingTypes()
    {
        return $this->hasMany(SubCategoriesWeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddingTypeTranslation()
    {
        return $this->hasOne(WeddingTypeTranslation::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeddings()
    {
        return $this->hasMany(Weddings::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }
}
