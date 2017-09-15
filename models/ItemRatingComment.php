<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item_rating_comment".
 *
 * @property integer $ITEM_SUPPLIER_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property integer $RATE
 * @property string $ITEM_COMMENT
 * @property string $COMMENT_APPROVE_FLAG
 *
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property CouplePartner $cOUPLEPARTNER
 */
class ItemRatingComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_rating_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'COUPLE_PARTNER_ID', 'RATE'], 'integer'],
            [['ITEM_COMMENT'], 'string', 'max' => 4000],
            [['COMMENT_APPROVE_FLAG'], 'string', 'max' => 1],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'RATE' => Yii::t('app', 'Rate'),
            'ITEM_COMMENT' => Yii::t('app', 'Item  Comment'),
            'COMMENT_APPROVE_FLAG' => Yii::t('app', 'Comment  Approve  Flag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }
}
