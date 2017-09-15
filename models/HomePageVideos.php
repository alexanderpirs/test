<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "home_page_videos".
 *
 * @property integer $VIDEO_ID
 * @property string $VIDEO_LINK
 * @property string $VIDEO_IMG
 * @property string $VIDEO_FLAG
 * @property string $VIDEO_NAME
 *
 * @property HomePageVideoCountries[] $homePageVideoCountries
 * @property HomePageVideoWeddingType[] $homePageVideoWeddingTypes
 */
class HomePageVideos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_page_videos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['VIDEO_LINK', 'VIDEO_IMG'], 'string', 'max' => 1000],
            [['VIDEO_FLAG'], 'string', 'max' => 1],
            [['VIDEO_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VIDEO_ID' => Yii::t('app', 'Video  ID'),
            'VIDEO_LINK' => Yii::t('app', 'Video  Link'),
            'VIDEO_IMG' => Yii::t('app', 'Video  Img'),
            'VIDEO_FLAG' => Yii::t('app', 'Video  Flag'),
            'VIDEO_NAME' => Yii::t('app', 'Video  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomePageVideoCountries()
    {
        return $this->hasMany(HomePageVideoCountries::className(), ['HOME_PAGE_VIDEO_ID' => 'VIDEO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHomePageVideoWeddingTypes()
    {
        return $this->hasMany(HomePageVideoWeddingType::className(), ['HOME_PAGE_VIDEO_ID' => 'VIDEO_ID']);
    }
}
