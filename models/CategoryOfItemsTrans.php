<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_of_items_trans".
 *
 * @property integer $CATEGORY_OF_ITEM_ID
 * @property string $CATEGORY_OF_ITEM_TRANS
 * @property integer $LANGUAGE_ID
 *
 * @property CategoryOfItems $cATEGORYOFITEM
 * @property Languages $lANGUAGE
 */
class CategoryOfItemsTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_of_items_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CATEGORY_OF_ITEM_ID', 'LANGUAGE_ID'], 'integer'],
            [['CATEGORY_OF_ITEM_TRANS'], 'string', 'max' => 100],
            [['CATEGORY_OF_ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CATEGORY_OF_ITEM_ID' => Yii::t('app', 'Category  Of  Item  ID'),
            'CATEGORY_OF_ITEM_TRANS' => Yii::t('app', 'Category  Of  Item  Trans'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORYOFITEM()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_OF_ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
