<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package_image".
 *
 * @property integer $PACKAGE_IMAGE_ID
 * @property string $IMAGE_PATH
 * @property integer $PACKAGE_ID
 *
 * @property Packages $pACKAGE
 */
class PackageImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'package_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PACKAGE_ID'], 'integer'],
            [['IMAGE_PATH'], 'string', 'max' => 1000],
            [['PACKAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['PACKAGE_ID' => 'PACKAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PACKAGE_IMAGE_ID' => Yii::t('app', 'Package  Image  ID'),
            'IMAGE_PATH' => Yii::t('app', 'Image  Path'),
            'PACKAGE_ID' => Yii::t('app', 'Package  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPACKAGE()
    {
        return $this->hasOne(Packages::className(), ['PACKAGE_ID' => 'PACKAGE_ID']);
    }
}
