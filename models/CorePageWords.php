<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "core_page_words".
 *
 * @property integer $CORE_PAGE_WORDS_ID
 * @property string $CORE_PAGE_WORD_VALUE
 * @property integer $WEDDING_ID
 *
 * @property CorePage[] $corePages
 * @property CorePage[] $corePages0
 * @property CorePage[] $corePages1
 * @property CorePage[] $corePages2
 * @property Weddings $wEDDING
 */
class CorePageWords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'core_page_words';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID'], 'integer'],
            [['CORE_PAGE_WORD_VALUE'], 'string', 'max' => 100],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CORE_PAGE_WORDS_ID' => Yii::t('app', 'Core  Page  Words  ID'),
            'CORE_PAGE_WORD_VALUE' => Yii::t('app', 'Core  Page  Word  Value'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorePages()
    {
        return $this->hasMany(CorePage::className(), ['INVITATION_FIRST_WORD' => 'CORE_PAGE_WORDS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorePages0()
    {
        return $this->hasMany(CorePage::className(), ['INVITATION_SECOND_WORD' => 'CORE_PAGE_WORDS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorePages1()
    {
        return $this->hasMany(CorePage::className(), ['INVITATION_THIRD_WORD' => 'CORE_PAGE_WORDS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorePages2()
    {
        return $this->hasMany(CorePage::className(), ['INVITATION_FORTH_WORD' => 'CORE_PAGE_WORDS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
