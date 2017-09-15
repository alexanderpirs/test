<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package_comments".
 *
 * @property integer $PACKAGE_COMMENT_ID
 * @property resource $PACKAGE_COMMENT_VALUE
 * @property integer $COUPLE_PARTNER_ID
 * @property string $POST_DATE
 * @property integer $RATING
 * @property integer $PACKAGE_ID
 *
 * @property CouplePartner $cOUPLEPARTNER
 * @property Packages $pACKAGE
 */
class PackageComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PACKAGE_COMMENT_VALUE'], 'string'],
            [['COUPLE_PARTNER_ID', 'RATING', 'PACKAGE_ID'], 'integer'],
            [['POST_DATE'], 'safe'],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['PACKAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['PACKAGE_ID' => 'PACKAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PACKAGE_COMMENT_ID' => Yii::t('app', 'Package  Comment  ID'),
            'PACKAGE_COMMENT_VALUE' => Yii::t('app', 'Package  Comment  Value'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'POST_DATE' => Yii::t('app', 'Post  Date'),
            'RATING' => Yii::t('app', 'Rating'),
            'PACKAGE_ID' => Yii::t('app', 'Package  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPACKAGE()
    {
        return $this->hasOne(Packages::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }
}
