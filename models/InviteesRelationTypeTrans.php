<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invitees_relation_type_trans".
 *
 * @property integer $RELATION_TYPE_ID
 * @property string $RELATION_TYPE_NAME_TRANS
 * @property integer $LANGUAGE_ID
 *
 * @property Languages $lANGUAGE
 * @property InviteeRelationTypes $rELATIONTYPE
 */
class InviteesRelationTypeTrans extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invitees_relation_type_trans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RELATION_TYPE_ID', 'LANGUAGE_ID'], 'integer'],
            [['RELATION_TYPE_NAME_TRANS'], 'string', 'max' => 40],
            [['LANGUAGE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['LANGUAGE_ID' => 'LANGUAGE_ID']],
            [['RELATION_TYPE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => InviteeRelationTypes::className(), 'targetAttribute' => ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RELATION_TYPE_ID' => Yii::t('app', 'Relation  Type  ID'),
            'RELATION_TYPE_NAME_TRANS' => Yii::t('app', 'Relation  Type  Name  Trans'),
            'LANGUAGE_ID' => Yii::t('app', 'Language  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLANGUAGE()
    {
        return $this->hasOne(Languages::className(), ['LANGUAGE_ID' => 'LANGUAGE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRELATIONTYPE()
    {
        return $this->hasOne(InviteeRelationTypes::className(), ['RELATION_TYPE_ID' => 'RELATION_TYPE_ID']);
    }
}
