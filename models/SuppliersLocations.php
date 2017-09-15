<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suppliers_locations".
 *
 * @property integer $SUPPLIER_ID
 * @property integer $COUNTRY_ID
 * @property integer $CITY_ID
 * @property string $LOCATION_DESC
 * @property string $GEO_LOCATION
 *
 * @property Suppliers $sUPPLIER
 * @property Countries $cOUNTRY
 * @property Cities $cITY
 */
class SuppliersLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers_locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPPLIER_ID'], 'required'],
            [['SUPPLIER_ID', 'COUNTRY_ID', 'CITY_ID'], 'integer'],
            [['LOCATION_DESC'], 'string', 'max' => 4000],
            [['GEO_LOCATION'], 'string', 'max' => 100],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['COUNTRY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['COUNTRY_ID' => 'COUNTRY_ID']],
            [['CITY_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['CITY_ID' => 'CITY_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'COUNTRY_ID' => Yii::t('app', 'Country'),
            'CITY_ID' => Yii::t('app', 'City'),
            'LOCATION_DESC' => Yii::t('app', 'Location  Desc'),
            'GEO_LOCATION' => Yii::t('app', 'Geo  Location'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUNTRY()
    {
        return $this->hasOne(Countries::className(), ['COUNTRY_ID' => 'COUNTRY_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCITY()
    {
        return $this->hasOne(Cities::className(), ['CITY_ID' => 'CITY_ID']);
    }
}
