<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "coupons_numbers".
 *
 * @property integer $MIN_NUMBER
 * @property integer $MAX_NUMBER
 */
class CouponsNumbers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupons_numbers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MIN_NUMBER', 'MAX_NUMBER'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MIN_NUMBER' => Yii::t('app', 'Min  Number'),
            'MAX_NUMBER' => Yii::t('app', 'Max  Number'),
        ];
    }
}
