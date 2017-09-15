<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sponsors".
 *
 * @property integer $SPONSOR_ID
 * @property string $SPONSOR_NAME
 *
 * @property CommercialWeddingSponsor[] $commercialWeddingSponsors
 * @property SponsorsCountries[] $sponsorsCountries
 */
class Sponsors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sponsors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SPONSOR_NAME'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SPONSOR_ID' => Yii::t('app', 'Sponsor  ID'),
            'SPONSOR_NAME' => Yii::t('app', 'Sponsor  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommercialWeddingSponsors()
    {
        return $this->hasMany(CommercialWeddingSponsor::className(), ['SPONSOR_ID' => 'SPONSOR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorsCountries()
    {
        return $this->hasMany(SponsorsCountries::className(), ['SPONSOR_ID' => 'SPONSOR_ID']);
    }
}
