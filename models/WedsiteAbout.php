<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wedsite_about".
 *
 * @property integer $WEDSITE_ABOUT_ID
 * @property integer $WEDDING_ID
 * @property resource $HIS_HISTORY
 * @property resource $HER_HISTORY
 * @property resource $OUR_HISTORY
 * @property resource $HIS_FIRST_PART
 * @property resource $HIS_SECOND_PART
 * @property resource $HER_FIRST_PART
 * @property resource $HER_SECOND_PART
 * @property string $HIS_FIRST_PART_PIC
 * @property string $HIS_SECOND_PART_PIC
 * @property string $HER_FIRST_PART_PIC
 * @property string $HER_SECOND_PART_PIC
 *
 * @property Weddings $wEDDING
 */
class WedsiteAbout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wedsite_about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WEDDING_ID'], 'integer'],
            [['HIS_HISTORY', 'HER_HISTORY', 'OUR_HISTORY', 'HIS_FIRST_PART', 'HIS_SECOND_PART', 'HER_FIRST_PART', 'HER_SECOND_PART'], 'string'],
            [['HIS_FIRST_PART_PIC', 'HIS_SECOND_PART_PIC', 'HER_FIRST_PART_PIC', 'HER_SECOND_PART_PIC'], 'string', 'max' => 1000],
            [['WEDDING_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Weddings::className(), 'targetAttribute' => ['WEDDING_ID' => 'WEDDING_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WEDSITE_ABOUT_ID' => Yii::t('app', 'Wedsite  About  ID'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
            'HIS_HISTORY' => Yii::t('app', 'His  History'),
            'HER_HISTORY' => Yii::t('app', 'Her  History'),
            'OUR_HISTORY' => Yii::t('app', 'Our  History'),
            'HIS_FIRST_PART' => Yii::t('app', 'His  First  Part'),
            'HIS_SECOND_PART' => Yii::t('app', 'His  Second  Part'),
            'HER_FIRST_PART' => Yii::t('app', 'Her  First  Part'),
            'HER_SECOND_PART' => Yii::t('app', 'Her  Second  Part'),
            'HIS_FIRST_PART_PIC' => Yii::t('app', 'His  First  Part  Pic'),
            'HIS_SECOND_PART_PIC' => Yii::t('app', 'His  Second  Part  Pic'),
            'HER_FIRST_PART_PIC' => Yii::t('app', 'Her  First  Part  Pic'),
            'HER_SECOND_PART_PIC' => Yii::t('app', 'Her  Second  Part  Pic'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWEDDING()
    {
        return $this->hasOne(Weddings::className(), ['WEDDING_ID' => 'WEDDING_ID']);
    }
}
