<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_about_galery".
 *
 * @property integer $WEDSITE_ABOUT_GALAERY_ID
 * @property string $IMAGE_PATH
 * @property integer $ORDER
 * @property integer $WEDDING_ID
 *
 * @property Weddings $wEDDING
 */
class WedsiteAboutGalery extends \yii\db\ActiveRecord
{
     public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_about_galery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'safe'],
            [['ORDER', 'WEDDING_ID'], 'integer'],
            [['IMAGE_PATH'], 'string', 'max' => 1000],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_ABOUT_GALAERY_ID' => Yii::t('app', 'Wedsite  About  Galaery  ID'),
            'IMAGE_PATH' => Yii::t('app', 'Image  Path'),
            'ORDER' => Yii::t('app', 'Order'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
