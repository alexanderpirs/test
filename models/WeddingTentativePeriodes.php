<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_tentative_periodes".
 *
 * @property integer $WEDDING_ID
 * @property string $FROM_DATE
 * @property string $TO_DATE
 * @property integer $POSTED_BY
 * @property integer $APPROVED_BY
 * @property string $ACTION_FLAG
 * @property string $NEED_TO_BE_APPROVED
 * @property integer $WEDDING_PERIODE_ID
 * @property integer $WEDDING_EVENT_ID
 * @property string $IN_USE_OR_NO 
 *
 * @property Weddings $wEDDING
 * @property CouplePartner $pOSTEDBY
 * @property CouplePartner $aPPROVEDBY
 * @property WeddingEvent $wEDDINGEVENT
 */
class WeddingTentativePeriodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_tentative_periodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'POSTED_BY', 'APPROVED_BY', 'WEDDING_EVENT_ID'], 'integer'],
            [['FROM_DATE', 'TO_DATE'], 'safe'],
//            [['TO_DATE'], 'required'],
            [['ACTION_FLAG', 'NEED_TO_BE_APPROVED', 'IN_USE_OR_NO'], 'string', 'max' => 1],
            [['ACTION_FLAG', 'NEED_TO_BE_APPROVED'], 'string', 'max' => 1],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['POSTED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['POSTED_BY' => 'COUPLE_PARTNER_ID']],
            [['APPROVED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['APPROVED_BY' => 'COUPLE_PARTNER_ID']],
            [['WEDDING_EVENT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingEvent::className(), 'targetAttribute' => ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'FROM_DATE' => Yii::t('app', 'From  Date'),
            'TO_DATE' => Yii::t('app', 'To  Date'),
            'POSTED_BY' => Yii::t('app', 'Posted  By'),
            'APPROVED_BY' => Yii::t('app', 'Approved  By'),
            'ACTION_FLAG' => Yii::t('app', 'Action  Flag'),
            'NEED_TO_BE_APPROVED' => Yii::t('app', 'Need  To  Be  Approved'),
            'WEDDING_PERIODE_ID' => Yii::t('app', 'Wedding  Periode  ID'),
            'WEDDING_EVENT_ID' => Yii::t('app', 'Wedding  Event  ID'),
            'IN_USE_OR_NO' => Yii::t('app', 'In Use Or No'), 
        ];
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
    public function getPOSTEDBY()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'POSTED_BY']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAPPROVEDBY()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'APPROVED_BY']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGEVENT()
    {
        return $this->hasOne(WeddingEvent::className(), ['WEDDING_EVENT_ID' => 'WEDDING_EVENT_ID']);
    }
}
