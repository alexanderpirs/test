<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package_descriptions".
 *
 * @property integer $PACKAGE_DESCRIPTION_ID
 * @property string $PACKAGE_DESCRIPTION_VALUE
 * @property integer $OPTION_ID
 * @property integer $ITEM_ID
 * @property integer $PACKAGE_ID
 *
 * @property ItemOptions $oPTION
 * @property ItemsSupplieirs $iTEM
 * @property Packages $pACKAGE
 */
class PackageDescriptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package_descriptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPTION_ID', 'ITEM_ID', 'PACKAGE_ID'], 'integer'],
            [['PACKAGE_DESCRIPTION_VALUE'], 'string', 'max' => 1000],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_SUPPLIER_ID']],
            [['PACKAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['PACKAGE_ID' => 'PACKAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PACKAGE_DESCRIPTION_ID' => Yii::t('app', 'Package  Description  ID'),
            'PACKAGE_DESCRIPTION_VALUE' => Yii::t('app', 'Package  Description  Value'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'PACKAGE_ID' => Yii::t('app', 'Package  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'OPTION_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPACKAGE()
    {
        return $this->hasOne(Packages::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }
}
