<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages_groups".
 *
 * @property integer $PACKAGE_GROUP_ID
 * @property string $PACKAGE_GROUP_VALUE
 *
 * @property Packages[] $packages
 */
class PackagesGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PACKAGE_GROUP_VALUE'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PACKAGE_GROUP_ID' => Yii::t('app', 'Package  Group  ID'),
            'PACKAGE_GROUP_VALUE' => Yii::t('app', 'Package  Group  Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackages()
    {
        return $this->hasMany(Packages::className(), ['PACKAGE_GROUP_ID' => 'PACKAGE_GROUP_ID']);
    }
}
