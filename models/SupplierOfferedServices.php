<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier_offered_services".
 *
 * @property integer $SUPPLIER_ID
 * @property integer $CATEGORY_ID
 *
 * @property Suppliers $sUPPLIER
 * @property CategoryOfItems $cATEGORY
 */
class SupplierOfferedServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier_offered_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_ID', 'CATEGORY_ID'], 'integer'],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['CATEGORY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryOfItems::className(), 'targetAttribute' => ['CATEGORY_ID' => 'CATEGORY_OF_ITEM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'CATEGORY_ID' => Yii::t('app', 'Category  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCATEGORY()
    {
        return $this->hasOne(CategoryOfItems::className(), ['CATEGORY_OF_ITEM_ID' => 'CATEGORY_ID']);
    }
}
