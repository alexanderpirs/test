<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_categories_countries".
 *
 * @property integer $SUB_CATEGORY_ID
 * @property integer $COUNTRY_ID
 *
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property Countries $cOUNTRY
 */
class SubCategoriesCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_categories_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUB_CATEGORY_ID', 'COUNTRY_ID'], 'integer'],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUBCATEGORY()
    {
        return $this->hasOne(SubCategoriesOfItems::className(), ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }
}
