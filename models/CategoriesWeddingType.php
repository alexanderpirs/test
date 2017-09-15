<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories_wedding_type".
 *
 * @property integer $CATEGORY_ID
 * @property integer $WEDDING_TYPE_ID
 *
 * @property CategoryOfItems $cATEGORY
 * @property WeddingType $wEDDINGTYPE
 */
class CategoriesWeddingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_wedding_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_ID', 'WEDDING_TYPE_ID'], 'integer'],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
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
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }
}
