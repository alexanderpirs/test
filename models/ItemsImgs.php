<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_imgs".
 *
 * @property integer $ITEM_SUPPLIER_ID
 * @property string $IMG_PATH
 * @property string $DEFAULT_OR_NO
 * @property integer $ITEM_SUPPLIER_IMAGE_ID 
 *
 * @property ItemsSupplieirs $iTEMSUPPLIER
 */
class ItemsImgs extends \yii\db\ActiveRecord
{
    
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items_imgs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file','ITEM_SUPPLIER_ID'], 'safe'],
            [['file'], 'file','maxFiles' => 999],
            [['ITEM_SUPPLIER_ID'], 'integer'],
            [['IMG_PATH'], 'string', 'max' => 300],
            [['DEFAULT_OR_NO'], 'string', 'max' => 45],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'IMG_PATH' => Yii::t('app', 'Img  Path'),
            'DEFAULT_OR_NO' => Yii::t('app', 'Default  Or  No'),
            'ITEM_SUPPLIER_IMAGE_ID' => Yii::t('app', 'Item Supplier Image ID'), 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }
}
