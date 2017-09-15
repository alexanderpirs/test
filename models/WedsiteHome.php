<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_home".
 *
 * @property integer $WEDSITE_HOME_ID
 * @property resource $GET_START
 * @property resource $WELCOME
 * @property resource $SAVE_THE_DATE
 * @property resource $CUSTOM
 * @property string $HEADER_PIC
 * @property string $WELCOME_PIC
 * @property string $SAVE_DATE_PIC
 * @property string $CUSTOM_PIC
 * @property integer $WEDDING_ID
 * @property resource $HOTEL_NAME
 * @property resource $INFO
 * @property resource $CUSTOM_PARAG
 *
 * @property Weddings $wEDDING
 */
class WedsiteHome extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_home';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GET_START', 'WELCOME', 'SAVE_THE_DATE', 'CUSTOM', 'HOTEL_NAME', 'INFO', 'CUSTOM_PARAG'], 'string'],
            [['WEDDING_ID'], 'integer'],
            [['HEADER_PIC', 'WELCOME_PIC', 'SAVE_DATE_PIC', 'CUSTOM_PIC'], 'string', 'max' => 1000],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_HOME_ID' => Yii::t('app', 'Wedsite  Home  ID'),
            'GET_START' => Yii::t('app', 'Get  Start'),
            'WELCOME' => Yii::t('app', 'Welcome'),
            'SAVE_THE_DATE' => Yii::t('app', 'Save  The  Date'),
            'CUSTOM' => Yii::t('app', 'Custom'),
            'HEADER_PIC' => Yii::t('app', 'Header  Pic'),
            'WELCOME_PIC' => Yii::t('app', 'Welcome  Pic'),
            'SAVE_DATE_PIC' => Yii::t('app', 'Save  Date  Pic'),
            'CUSTOM_PIC' => Yii::t('app', 'Custom  Pic'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'HOTEL_NAME' => Yii::t('app', 'Hotel  Name'),
            'INFO' => Yii::t('app', 'Info'),
            'CUSTOM_PARAG' => Yii::t('app', 'Custom  Parag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
