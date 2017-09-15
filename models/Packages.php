<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property integer $PACKAGE_ID
 * @property string $PACKAGE_PRICE
 * @property integer $CURRENCY_ID
 * @property integer $SUPPLIER_ID
 * @property string $PACKAGE_NAME
 * @property integer $PACKAGE_PREVIEW
 * @property integer $PACKAGE_RATE
 *
 * @property PackageComments[] $packageComments
 * @property PackageDescriptions[] $packageDescriptions
 * @property PackageImage[] $packageImages
 * @property Currencies $cURRENCY
 * @property Suppliers $sUPPLIER
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CURRENCY_ID', 'SUPPLIER_ID', 'PACKAGE_PREVIEW', 'PACKAGE_RATE'], 'integer'],
            [['PACKAGE_PRICE'], 'string', 'max' => 45],
            [['PACKAGE_NAME'], 'string', 'max' => 1000],
            [['CURRENCY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['CURRENCY_ID' => 'CURRENCY_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PACKAGE_ID' => Yii::t('app', 'Package  ID'),
            'PACKAGE_PRICE' => Yii::t('app', 'Package  Price'),
            'CURRENCY_ID' => Yii::t('app', 'Currency  ID'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'PACKAGE_NAME' => Yii::t('app', 'Package  Name'),
            'PACKAGE_PREVIEW' => Yii::t('app', 'Package  Preview'),
            'PACKAGE_RATE' => Yii::t('app', 'Package  Rate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageComments()
    {
        return $this->hasMany(PackageComments::className(), ['PACKAGE_ID' => 'PACKAGE_ID'])->orderBy('POST_DATE DESC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageDescriptions()
    {
        return $this->hasMany(PackageDescriptions::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackageImages()
    {
        return $this->hasMany(PackageImage::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCURRENCY()
    {
        return $this->hasOne(Currencies::className(), ['CURRENCY_ID' => 'CURRENCY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }
}
