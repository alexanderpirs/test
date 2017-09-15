<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_topics".
 *
 * @property integer $WEDSITE_TOPIC_ID
 * @property string $TOPIC_VALUE
 * @property string $WEDSITE_TOPIC_DATE
 * @property integer $WEDDING_ID
 * @property integer $POSTED_BY
 * @property string $TOPIC_TITLE
 *
 * @property WedsiteTopicComments[] $wedsiteTopicComments
 * @property Weddings $wEDDING
 * @property CouplePartner $pOSTEDBY
 */
class WedsiteTopics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_topics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDSITE_TOPIC_DATE'], 'safe'],
            [['TOPIC_VALUE','TOPIC_TITLE'], 'required'],
            [['WEDDING_ID', 'POSTED_BY'], 'integer'],
            [['TOPIC_VALUE'], 'string', 'max' => 500],
            [['TOPIC_TITLE'], 'string', 'max' => 45],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['POSTED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['POSTED_BY' => 'COUPLE_PARTNER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_TOPIC_ID' => Yii::t('app', 'Wedsite  Topic  ID'),
            'TOPIC_VALUE' => Yii::t('app', 'Topic  Value'),
            'WEDSITE_TOPIC_DATE' => Yii::t('app', 'Wedsite  Topic  Date'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'POSTED_BY' => Yii::t('app', 'Posted  By'),
            'TOPIC_TITLE' => Yii::t('app', 'Topic  Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWedsiteTopicComments()
    {
        return $this->hasMany(WedsiteTopicComments::className(), ['WEDSITE_TOPIC_ID' => 'WEDSITE_TOPIC_ID']);
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
}
