<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_about_family".
 *
 * @property integer $WEDSITE_ABOUT_FAMILY_ID
 * @property string $WEDSITE_ABOUT_FAMILY_NAME
 * @property resource $WEDSITE_ABOUT_FAMILY_DESCRIPTION
 * @property integer $RELATED_TO
 * @property integer $WEDDING_ID
 *
 * @property CouplePartner $rELATEDTO
 * @property Weddings $wEDDING
 */
class WedsiteAboutFamily extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_about_family';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDSITE_ABOUT_FAMILY_NAME'], 'required'],
            [['WEDSITE_ABOUT_FAMILY_DESCRIPTION'], 'string'],
            [['RELATED_TO', 'WEDDING_ID'], 'integer'],
            [['WEDSITE_ABOUT_FAMILY_NAME'], 'string', 'max' => 45],
            [['RELATED_TO'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['RELATED_TO' => 'COUPLE_PARTNER_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_ABOUT_FAMILY_ID' => Yii::t('app', 'Wedsite  About  Family  ID'),
            'WEDSITE_ABOUT_FAMILY_NAME' => Yii::t('app', 'Name  '),
            'WEDSITE_ABOUT_FAMILY_DESCRIPTION' => Yii::t('app', 'Wedsite  About  Family  Description'),
            'RELATED_TO' => Yii::t('app', 'Related  To'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELATEDTO()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'RELATED_TO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
