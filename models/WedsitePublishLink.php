<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_publish_link".
 *
 * @property integer $WEDSITE_PUBLISH_LINK_ID
 * @property string $LINK
 * @property integer $WEDDING_ID
 * @property string $PUBLISHED_ON
 * @property integer $PUBLISHED_BY
 * @property string $LINK_PIN_CODE
 *
 * @property Weddings $wEDDING
 * @property CouplePartner $pUBLISHEDBY
 */
class WedsitePublishLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_publish_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID', 'PUBLISHED_BY'], 'integer'],
            [['PUBLISHED_ON'], 'safe'],
            [['LINK'], 'string', 'max' => 1000],
            [['LINK_PIN_CODE'], 'string', 'max' => 45],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['PUBLISHED_BY'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['PUBLISHED_BY' => 'COUPLE_PARTNER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_PUBLISH_LINK_ID' => Yii::t('app', 'Wedsite  Publish  Link  ID'),
            'LINK' => Yii::t('app', 'Link'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'PUBLISHED_ON' => Yii::t('app', 'Published  On'),
            'PUBLISHED_BY' => Yii::t('app', 'Published  By'),
            'LINK_PIN_CODE' => Yii::t('app', 'Link  Pin  Code'),
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
    public function getPUBLISHEDBY()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'PUBLISHED_BY']);
    }
}
