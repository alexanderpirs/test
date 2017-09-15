<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suplier_type_trans".
 *
 * @property integer $SUPLIER_TYPE_ID
 * @property string $SUPLIER_TYPE_NAME
 * @property integer $LANGUAGE_ID
 *
 * @property SupplierTypes $sUPLIERTYPE
 * @property Languages $lANGUAGE
 */
class SuplierTypeTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suplier_type_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SUPLIER_TYPE_ID', 'LANGUAGE_ID'], 'integer'],
            [['SUPLIER_TYPE_NAME'], 'string', 'max' => 50],
            [['SUPLIER_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SupplierTypes::className(), 'targetAttribute' => ['SUPLIER_TYPE_ID' => 'SUPPLIER_TYPE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SUPLIER_TYPE_ID' => Yii::t('app', 'Suplier  Type  ID'),
            'SUPLIER_TYPE_NAME' => Yii::t('app', 'Suplier  Type  Name'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPLIERTYPE()
    {
        return $this->hasOne(SupplierTypes::className(), ['SUPPLIER_TYPE_ID' => 'SUPLIER_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
