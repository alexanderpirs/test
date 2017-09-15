<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
//use yii\base\Model;
/**
 * This is the model class for table "item_view_number".
 *
 * @property integer $ITEM_VIEW_ID
 * @property integer $ITEM_SUPPLIER_ID
 * @property string $VIEW_DATE
 * @property integer $SUPPLIER_ID
 * @property integer $COUPLE_PARTNER_ID
 * @property string $NEW_OR_NO 
 * 
 * @property ItemsSupplieirs $iTEMSUPPLIER
 * @property Suppliers $sUPPLIER
 * @property CouplePartner $cOUPLEPARTNER
 */
class ItemViewNumber extends \yii\db\ActiveRecord
{
    
    public $NumberCounter;
    public $DiscNumberCounter;
    public $SalesNumberCounter;
    public $LeadsNumberCounter;
    public $RatingAverage;
    public $ReviewsNumber;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_view_number';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ITEM_SUPPLIER_ID', 'SUPPLIER_ID', 'COUPLE_PARTNER_ID'], 'integer'],
            [['VIEW_DATE','NumberCounter','DiscNumberCounter','SalesNumberCounter','LeadsNumberCounter','RatingAverage','ReviewsNumber'], 'safe'],
            [['NEW_OR_NO'], 'string', 'max' => 1],
            [['ITEM_SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ItemsSupplieirs::className(), 'targetAttribute' => ['ITEM_SUPPLIER_ID' => 'ITEM_SUPPLIER_ID']],
            [['SUPPLIER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['SUPPLIER_ID' => 'SUPPLIER_ID']],
            [['COUPLE_PARTNER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CouplePartner::className(), 'targetAttribute' => ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ITEM_VIEW_ID' => Yii::t('app', 'Item  View  ID'),
            'ITEM_SUPPLIER_ID' => Yii::t('app', 'Item  Supplier  ID'),
            'VIEW_DATE' => Yii::t('app', 'View  Date'),
            'SUPPLIER_ID' => Yii::t('app', 'Supplier  ID'),
            'COUPLE_PARTNER_ID' => Yii::t('app', 'Couple  Partner  ID'),
            'NEW_OR_NO' => Yii::t('app', 'New Or No'), 
        ];
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
    public function getSUPPLIER()
    {
        return $this->hasOne(Suppliers::className(), ['SUPPLIER_ID' => 'SUPPLIER_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOUPLEPARTNER()
    {
        return $this->hasOne(CouplePartner::className(), ['COUPLE_PARTNER_ID' => 'COUPLE_PARTNER_ID']);
    }
    
    
     public function search($params)
{               
    $query = ItemViewNumber::find()->select([
        'item_view_number.ITEM_SUPPLIER_ID',
        'VIEW_DATE',
        'item_view_number.SUPPLIER_ID',
        'COUPLE_PARTNER_ID',
        '(select COUNT(*) from item_view_number op where op.SUPPLIER_ID = 44 and op.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID  AND ACTION_FLAG = \'V\') as NumberCounter',
        '(select COUNT(*) from item_view_number op where op.SUPPLIER_ID = 44 and op.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID AND NEW_OR_NO = \'Y\' AND ACTION_FLAG = \'V\') as DiscNumberCounter',
        '(select COUNT(*) from item_view_number op where op.SUPPLIER_ID = 44 and op.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID AND ACTION_FLAG = \'L\') as LeadsNumberCounter',
        '(select COUNT(*) from item_view_number op where op.SUPPLIER_ID = 44 and op.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID AND ACTION_FLAG = \'S\') as SalesNumberCounter',
        '(select SUM(ComRating.RATE)/COUNT(ComRating.ITEM_RATING_COMMENT_ID) from item_rating_comment ComRating where ComRating.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID ) as RatingAverage',
        '(select COUNT(ComRating.ITEM_RATING_COMMENT_ID) from item_rating_comment ComRating where ComRating.ITEM_SUPPLIER_ID = item_view_number.ITEM_SUPPLIER_ID ) as ReviewsNumber'
        ])
         ->innerJoin('items_supplieirs','items_supplieirs.ITEM_SUPPLIER_ID=item_view_number.ITEM_SUPPLIER_ID')->innerJoin('items','items.ITEM_ID=items_supplieirs.ITEM_ID')->innerJoin('items_trans','items.ITEM_ID=items_trans.ITEM_ID');

    $this->load($params);                                                               



    if(!empty($this->ItemName)){
        Yii::error("this->ItemName : " .$this->ItemName);
        $query->filterWhere(['like','items_trans.ITEM_NAME',$this->ItemName]);
                
    }
        $query->groupBy([ 'ITEM_SUPPLIER_ID','SUPPLIER_ID']);
    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => false,
    ]);

    $dataProvider->sort->attributes['ItemName'] = [
        'asc' => ['items_trans.ITEM_NAME' => SORT_ASC],
        'desc' => ['items_trans.ITEM_NAME' => SORT_DESC]
    ];
     $dataProvider->sort->attributes['counter'] = [
        'asc' => ['NumberCounter' => SORT_ASC],
        'desc' => ['NumberCounter' => SORT_DESC]
    ];



    return $dataProvider;
}
}
