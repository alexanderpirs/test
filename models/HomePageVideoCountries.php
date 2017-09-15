<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "home_page_video_countries".
 *
 * @property integer $HOME_PAGE_VIDEO_ID
 * @property integer $COUNTRY_ID
 * @property integer $home_page_video_countries_id
 *
 * @property HomePageVideos $hOMEPAGEVIDEO
 * @property Countries $cOUNTRY
 */
class HomePageVideoCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_page_video_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOME_PAGE_VIDEO_ID', 'COUNTRY_ID'], 'integer'],
            [['HOME_PAGE_VIDEO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => HomePageVideos::className(), 'targetAttribute' => ['HOME_PAGE_VIDEO_ID' => 'VIDEO_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOME_PAGE_VIDEO_ID' => Yii::t('app', 'Home  Page  Video  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country  ID'),
            'home_page_video_countries_id' => Yii::t('app', 'Home Page Video Countries ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHOMEPAGEVIDEO()
    {
        return $this->hasOne(HomePageVideos::className(), ['VIDEO_ID' => 'HOME_PAGE_VIDEO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }
}
