<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_categories_trans".
 *
 * @property integer $SUB_CATEGORY_ID
 * @property string $SUB_CATEGORY_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property SubCategoriesOfItems $sUBCATEGORY
 * @property Languages $lANGUAGE
 */
class SubCategoriesTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_categories_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUB_CATEGORY_ID', 'LANGUAGE_ID'], 'integer'],
            [['SUB_CATEGORY_NAME'], 'string', 'max' => 50],
            [['SUB_CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategoriesOfItems::className(), 'targetAttribute' => ['SUB_CATEGORY_ID' => 'SUB_CATEGORY_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUB_CATEGORY_ID' => Yii::t('app', 'Sub  Category  ID'),
            'SUB_CATEGORY_NAME' => Yii::t('app', 'Sub  Category  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
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
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
