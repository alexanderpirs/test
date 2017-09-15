<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items_agenda".
 *
 * @property integer $ITEM_ID
 * @property integer $TASK_ID
 *
 * @property Items $iTEM
 * @property Agenda $tASK
 */
class ItemsAgenda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items_agenda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_ID', 'TASK_ID'], 'integer'],
            [['ITEM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['ITEM_ID' => 'ITEM_ID']],
            [['TASK_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Agenda::className(), 'targetAttribute' => ['TASK_ID' => 'TASK_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_ID' => Yii::t('app', 'Item  ID'),
            'TASK_ID' => Yii::t('app', 'Task  ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEM()
    {
        return $this->hasOne(Items::className(), ['ITEM_ID' => 'ITEM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTASK()
    {
        return $this->hasOne(Agenda::className(), ['TASK_ID' => 'TASK_ID']);
    }
}
