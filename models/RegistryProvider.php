<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registry_provider".
 *
 * @property integer $CORE_PAGE_ID
 * @property integer $SUPPLIER_ID
 *
 * @property CorePage $cOREPAGE
 * @property Suppliers $sUPPLIER
 */
class RegistryProvider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registry_provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CORE_PAGE_ID', 'SUPPLIER_ID'], 'integer'],
            [['CORE_PAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CorePage::className(), 'targetAttribute' => ['CORE_PAGE_ID' => 'CORE_PAGE_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CORE_PAGE_ID' => Yii::t('app', 'Core  Page  ID'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOREPAGE()
    {
        return $this->hasOne(CorePage::className(), ['CORE_PAGE_ID' => 'CORE_PAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }
}
