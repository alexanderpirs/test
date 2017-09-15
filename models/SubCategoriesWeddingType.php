<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_categories_wedding_type".
 *
 * @property integer $SUB_CATEGORY_ID
 * @property integer $WEDDING_TYPE_ID
 *
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property WeddingType $wEDDINGTYPE
 */
class SubCategoriesWeddingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_categories_wedding_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUB_CATEGORY_ID', 'WEDDING_TYPE_ID'], 'integer'],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
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
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }
}
