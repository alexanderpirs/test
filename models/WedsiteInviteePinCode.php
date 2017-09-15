<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_invitee_pin_code".
 *
 * @property integer $WEDSTE_INVITEE_PIN_CODE_ID
 * @property integer $INVITEE_ID
 * @property string $INVITEE_PIN_CODE
 * @property integer $WEDDING_ID
 * @property string $INVITEE_EMAIL
 *
 * @property Invitees $iNVITEE
 * @property Weddings $wEDDING
 */
class WedsiteInviteePinCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_invitee_pin_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INVITEE_ID', 'WEDDING_ID'], 'integer'],
            [['INVITEE_PIN_CODE'], 'string', 'max' => 45],
            [['INVITEE_EMAIL'], 'string', 'max' => 1000],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSTE_INVITEE_PIN_CODE_ID' => Yii::t('app', 'Wedste  Invitee  Pin  Code  ID'),
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
            'INVITEE_PIN_CODE' => Yii::t('app', 'Invitee  Pin  Code'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'INVITEE_EMAIL' => Yii::t('app', 'Invitee  Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINVITEE()
    {
        return $this->hasOne(Invitees::className(), ['INVITEE_ID' => 'INVITEE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
