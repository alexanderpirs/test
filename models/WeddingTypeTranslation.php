<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedding_type_translation".
 *
 * @property integer $WEDDING_TYPE_ID
 * @property string $WEDDING_TYPE_TRANSLATION
 * @property integer $LANGUAGE_ID
 *
 * @property WeddingType $wEDDINGTYPE
 * @property Languages $lANGUAGE
 */
class WeddingTypeTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedding_type_translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_TYPE_ID'], 'required'],
            [['WEDDING_TYPE_ID', 'LANGUAGE_ID'], 'integer'],
            [['WEDDING_TYPE_TRANSLATION'], 'string', 'max' => 100],
            [['WEDDING_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => WeddingType::className(), 'targetAttribute' => ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDDING_TYPE_ID' => Yii::t('app', 'Wedding  Type  ID'),
            'WEDDING_TYPE_TRANSLATION' => Yii::t('app', 'Wedding  Type  Translation'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDINGTYPE()
    {
        return $this->hasOne(WeddingType::className(), ['WEDDING_TYPE_ID' => 'WEDDING_TYPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }
}
