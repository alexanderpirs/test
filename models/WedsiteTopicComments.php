<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_topic_comments".
 *
 * @property integer $WEDSITE_TOPIC_COMMENT_ID
 * @property resource $WEDSITE_TOPIC_COMMENT
 * @property integer $POSTED_BY
 * @property integer $INVITEE_ID
 * @property string $POSTED_DATE_TIME
 * @property integer $WEDDING_ID
 * @property integer $WEDSITE_TOPIC_ID
 *
 * @property Invitees $iNVITEE
 * @property Weddings $wEDDING
 * @property CouplePartner $pOSTEDBY
 * @property WedsiteTopics $wEDSITETOPIC
 */
class WedsiteTopicComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_topic_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDSITE_TOPIC_COMMENT'], 'string'],
            [['POSTED_BY', 'INVITEE_ID', 'WEDDING_ID', 'WEDSITE_TOPIC_ID'], 'integer'],
            [['POSTED_DATE_TIME'], 'safe'],
            [['INVITEE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Invitees::className(), 'targetAttribute' => ['INVITEE_ID' => 'INVITEE_ID']],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['POSTED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['POSTED_BY' => 'COUPLE_PARTNER_ID']],
            [['WEDSITE_TOPIC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WedsiteTopics::className(), 'targetAttribute' => ['WEDSITE_TOPIC_ID' => 'WEDSITE_TOPIC_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_TOPIC_COMMENT_ID' => Yii::t('app', 'Wedsite  Topic  Comment  ID'),
            'WEDSITE_TOPIC_COMMENT' => Yii::t('app', 'Wedsite  Topic  Comment'),
            'POSTED_BY' => Yii::t('app', 'Posted  By'),
            'INVITEE_ID' => Yii::t('app', 'Invitee  ID'),
            'POSTED_DATE_TIME' => Yii::t('app', 'Posted  Date  Time'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'WEDSITE_TOPIC_ID' => Yii::t('app', 'Wedsite  Topic  ID'),
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
    public function getWEDSITETOPIC()
    {
        return $this->hasOne(WedsiteTopics::className(), ['WEDSITE_TOPIC_ID' => 'WEDSITE_TOPIC_ID']);
    }
}
