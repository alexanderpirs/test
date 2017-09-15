<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "home_page_video_wedding_type".
 *
 * @property integer $HOME_PAGE_VIDEO_ID
 * @property integer $WEDDING_TYPE_ID
 * @property integer $home_page_video_wedding_type_id
 *
 * @property HomePageVideos $hOMEPAGEVIDEO
 * @property WeddingType $wEDDINGTYPE
 */
class HomePageVideoWeddingType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_page_video_wedding_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOME_PAGE_VIDEO_ID', 'WEDDING_TYPE_ID'], 'integer'],
            [['HOME_PAGE_VIDEO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => HomePageVideos::className(), 'targetAttribute' => ['HOME_PAGE_VIDEO_ID' => 'VIDEO_ID']],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOME_PAGE_VIDEO_ID' => Yii::t('app', 'Home  Page  Video  ID'),
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
            'home_page_video_wedding_type_id' => Yii::t('app', 'Home Page Video Wedding Type ID'),
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
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }
}
