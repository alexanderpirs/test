<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_about_team".
 *
 * @property integer $WEDSITE_ABOUT_TEAM_ID
 * @property string $WEDSITE_ABOUT_TEAM_MEMBER_NAME
 * @property resource $WEDSITE_ABOUT_TEAM_MEMBER_DESC
 * @property integer $RELATED_TO
 * @property integer $WEDDING_ID
 *
 * @property CouplePartner $rELATEDTO
 * @property Weddings $wEDDING
 */
class WedsiteAboutTeam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_about_team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDSITE_ABOUT_TEAM_MEMBER_DESC'], 'string'],
            [['RELATED_TO', 'WEDDING_ID'], 'integer'],
            [['WEDSITE_ABOUT_TEAM_MEMBER_NAME'], 'string', 'max' => 45],
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
            'WEDSITE_ABOUT_TEAM_ID' => Yii::t('app', 'Wedsite  About  Team  ID'),
            'WEDSITE_ABOUT_TEAM_MEMBER_NAME' => Yii::t('app', 'Wedsite  About  Team  Member  Name'),
            'WEDSITE_ABOUT_TEAM_MEMBER_DESC' => Yii::t('app', 'Wedsite  About  Team  Member  Desc'),
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
