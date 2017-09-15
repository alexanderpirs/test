<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "saving".
 *
 * @property integer $SAVING_ID
 * @property string $SAVING_BANK_NAME
 * @property integer $OPTION_ID
 * @property integer $ITEM_ID
 * @property integer $SUPPLIER_ID
 * @property string $AMOUNT
 * @property integer $CURRENCY_ID
 * @property string $NUMBER_OF_MONTHES
 * @property string $RATE
 * @property string $TOTAL
 * @property integer $WEDDING_ID
 *
 * @property Items $iTEM
 * @property ItemOptions $oPTION
 * @property Suppliers $sUPPLIER
 * @property Currencies $cURRENCY
 * @property Weddings $wEDDING
 * @property SavingCommercialSponsor[] $savingCommercialSponsors
 * @property SavingPersonalContribution[] $savingPersonalContributions
 * @property SavingPrivateSponsor[] $savingPrivateSponsors
 */
class Saving extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'saving';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OPTION_ID', 'ITEM_ID', 'SUPPLIER_ID', 'CURRENCY_ID', 'WEDDING_ID'], 'integer'],
            [['SAVING_BANK_NAME'], 'string', 'max' => 50],
            [['AMOUNT', 'NUMBER_OF_MONTHES', 'RATE', 'TOTAL'], 'string', 'max' => 20],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['OPTION_ID' => 'OPTION_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SAVING_ID' => Yii::t('app', 'Saving  ID'),
            'SAVING_BANK_NAME' => Yii::t('app', 'Saving  Bank  Name'),
            'OPTION_ID' => Yii::t('app', 'Option  ID'),
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'AMOUNT' => Yii::t('app', 'Amount'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'NUMBER_OF_MONTHES' => Yii::t('app', 'Number  Of  Monthes'),
            'RATE' => Yii::t('app', 'Rate'),
            'TOTAL' => Yii::t('app', 'Total'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
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
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavingCommercialSponsors()
    {
        return $this->hasMany(SavingCommercialSponsor::className(), ['SAVING_ID' => 'SAVING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavingPersonalContributions()
    {
        return $this->hasMany(SavingPersonalContribution::className(), ['SAVING_ID' => 'SAVING_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSavingPrivateSponsors()
    {
        return $this->hasMany(SavingPrivateSponsor::className(), ['SAVING_ID' => 'SAVING_ID']);
    }
}
