<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transactions;
/**
 * This is the model class for table "transactions".
 *
 * @property integer $TRANSACTION_ID
 * @property string $TRANSACTION_REF
 * @property integer $COUPLE_PARTNER_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property integer $ITEM_OPTION_ID
 * @property string $TRANSACTION_TYPE
 * @property string $TRANSACTION_DATE
 * @property string $TRANCTION_APPROVED
 *
 * @property CouplePartner $cOUPLEPARTNER
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property ItemOptions $iTEMOPTION
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COUPLE_PARTNER_ID', 'ITEM_SUPPLIER_ID', 'ITEM_OPTION_ID'], 'integer'],
            [['TRANSACTION_ID', 'COUPLE_PARTNER_ID', 'ITEM_SUPPLIER_ID', 'ITEM_OPTION_ID', 'SUPPLIER_ID'], 'integer'],
            [['TRANSACTION_REF', 'TRANSACTION_TYPE', 'TRANSACTION_DATE', 'TRANCTION_APPROVED'], 'safe'],
            [['TRANSACTION_DATE'], 'safe'],
            [['TRANSACTION_REF'], 'string', 'max' => 45],
            [['TRANSACTION_TYPE', 'TRANCTION_APPROVED'], 'string', 'max' => 1],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['ITEM_OPTION_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemOptions::className(), 'targetAttribute' => ['ITEM_OPTION_ID' => 'OPTION_ID']],
        ];
    }

    
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRANSACTION_ID' => Yii::t('app', 'Transaction  ID'),
            'TRANSACTION_REF' => Yii::t('app', 'Transaction  Ref'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'ITEM_OPTION_ID' => Yii::t('app', 'Item  Option  ID'),
            'TRANSACTION_TYPE' => Yii::t('app', 'Transaction  Type'),
            'TRANSACTION_DATE' => Yii::t('app', 'Transaction  Date'),
            'TRANCTION_APPROVED' => Yii::t('app', 'Tranction  Approved'),
        ];
    }

    
    
    
        public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Transactions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'TRANSACTION_ID' => $this->TRANSACTION_ID,
            'COUPLE_PARTNER_ID' => $this->COUPLE_PARTNER_ID,
            'ITEM_SUPPLIER_ID' => $this->ITEM_SUPPLIER_ID,
            'ITEM_OPTION_ID' => $this->ITEM_OPTION_ID,
            'TRANSACTION_DATE' => $this->TRANSACTION_DATE,
            'SUPPLIER_ID' => $this->SUPPLIER_ID,
        ]);

        $query->andFilterWhere(['like', 'TRANSACTION_REF', $this->TRANSACTION_REF])
            ->andFilterWhere(['like', 'TRANSACTION_TYPE', $this->TRANSACTION_TYPE])
            ->andFilterWhere(['like', 'TRANCTION_APPROVED', $this->TRANCTION_APPROVED]);

        return $dataProvider;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMSUPPLIER()
    {
        return $this->hasOne(ItemsSupplieirs::className(), ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITEMOPTION()
    {
        return $this->hasOne(ItemOptions::className(), ['OPTION_ID' => 'ITEM_OPTION_ID']);
    }
}
