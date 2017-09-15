<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form about `app\models\Transactions`.
 */
class TransactionsSearch extends Transactions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRANSACTION_ID', 'COUPLE_PARTNER_ID', 'ITEM_SUPPLIER_ID', 'ITEM_OPTION_ID', 'SUPPLIER_ID'], 'integer'],
            [['TRANSACTION_REF', 'TRANSACTION_TYPE', 'TRANSACTION_DATE', 'TRANCTION_APPROVED'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
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
}
