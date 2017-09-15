<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card_design".
 *
 * @property integer $CART_DESIGN_ID
 * @property integer $CARD_SHAPE_ID
 * @property integer $CARD_SIZE_ID
 * @property integer $CARD_PAPER_ID
 * @property integer $CARD_PAPER_MATERIAL_ID
 * @property string $CARD_COLOR
 * @property string $TEXT_PROPERTIES
 * @property integer $LANGUAGE_ID
 * @property integer $CARD_TEXT_STYLE_ID
 * @property string $CART_TEXT_COLOR
 * @property integer $CARD_PROPERTIES_ID
 * @property string $CARD_CUSTOM_PROPERTIES
 * @property integer $ENVELOPE_TYPE_ID
 * @property string $ENVELOPE_PAPER_MATERIAL_ID
 * @property string $ENVELOPE_COLOR
 * @property string $ENVELOPE_TEXT_PROPERTIES
 * @property integer $ENVELOPE_LANGUAGE_ID
 * @property integer $ENVELOPER_TEXT_STYLE
 * @property string $ENVELOPE_TEXT_COLOR
 * @property integer $ENVELOPE_PROPERTIES_ID
 * @property string $ENVELOPE_CUSTOM_PROPERTIES
 * @property integer $WEDDING_ID
 */
class CardDesign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'card_design';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CARD_SHAPE_ID', 'CARD_SIZE_ID', 'CARD_PAPER_ID', 'CARD_PAPER_MATERIAL_ID', 'LANGUAGE_ID', 'CARD_TEXT_STYLE_ID', 'CARD_PROPERTIES_ID', 'ENVELOPE_TYPE_ID', 'ENVELOPE_PAPER_MATERIAL_ID', 'ENVELOPE_LANGUAGE_ID', 'ENVELOPER_TEXT_STYLE', 'ENVELOPE_PROPERTIES_ID', 'WEDDING_ID'], 'integer'],
            [['CARD_COLOR', 'TEXT_PROPERTIES', 'CART_TEXT_COLOR', 'ENVELOPE_COLOR', 'ENVELOPE_TEXT_PROPERTIES', 'ENVELOPE_TEXT_COLOR'], 'string', 'max' => 45],
            [['CARD_CUSTOM_PROPERTIES'], 'string', 'max' => 4000],
            [['ENVELOPE_CUSTOM_PROPERTIES'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CART_DESIGN_ID' => Yii::t('app', 'Cart  Design  ID'),
            'CARD_SHAPE_ID' => Yii::t('app', 'Card  Shape  ID'),
            'CARD_SIZE_ID' => Yii::t('app', 'Card  Size  ID'),
            'CARD_PAPER_ID' => Yii::t('app', 'Card  Paper  ID'),
            'CARD_PAPER_MATERIAL_ID' => Yii::t('app', 'Card  Paper  Material  ID'),
            'CARD_COLOR' => Yii::t('app', 'Card  Color'),
            'TEXT_PROPERTIES' => Yii::t('app', 'Text  Properties'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
            'CARD_TEXT_STYLE_ID' => Yii::t('app', 'Card  Text  Style  ID'),
            'CART_TEXT_COLOR' => Yii::t('app', 'Cart  Text  Color'),
            'CARD_PROPERTIES_ID' => Yii::t('app', 'Card  Properties  ID'),
            'CARD_CUSTOM_PROPERTIES' => Yii::t('app', 'Card  Custom  Properties'),
            'ENVELOPE_TYPE_ID' => Yii::t('app', 'Envelope  Type  ID'),
            'ENVELOPE_PAPER_MATERIAL_ID' => Yii::t('app', 'Envelope  Paper  Material  ID'),
            'ENVELOPE_COLOR' => Yii::t('app', 'Envelope  Color'),
            'ENVELOPE_TEXT_PROPERTIES' => Yii::t('app', 'Envelope  Text  Properties'),
            'ENVELOPE_LANGUAGE_ID' => Yii::t('app', 'Envelope  Language  ID'),
            'ENVELOPER_TEXT_STYLE' => Yii::t('app', 'Enveloper  Text  Style'),
            'ENVELOPE_TEXT_COLOR' => Yii::t('app', 'Envelope  Text  Color'),
            'ENVELOPE_PROPERTIES_ID' => Yii::t('app', 'Envelope  Properties  ID'),
            'ENVELOPE_CUSTOM_PROPERTIES' => Yii::t('app', 'Envelope  Custom  Properties'),
            'WEDDING_ID' => Yii::t('app', 'Wedding  ID'),
        ];
    }
}
