<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories_countries".
 *
 * @property integer $CATEGORY_ID
 * @property integer $COUNTRY_ID
 *
 * @property CategoryOfItems $cATEGORY
 * @property Countries $cOUNTRY
 */
class CategoriesCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID', 'COUNTRY_ID'], 'integer'],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORY()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }
}
