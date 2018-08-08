<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.09.17
 * Time: 17:13
 */

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Items;
use app\modules\admin\models\Users;

class OrdersSearch extends TempTable
{
//public $name;
//    public $fullname;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'userId','status'], 'integer'],
            [['date_order','address','name','surename',
            'email','phones','phone2','fullname'], 'safe'],
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
     * @param string $status
     *
     * @return ActiveDataProvider
     */
    public function searchOrders($params)
    {

        $order = new TempTable();
//        $order::setTable($params);
        $query =   $order::find();
        $dataProvider = new ActiveDataProvider(['query' => $query,]);

        $this->load(Yii::$app->request->queryParams);

        if (!$this->validate()) {
            return $dataProvider;
        }

//        $query
//            ->andFilterWhere(['status' => $params])
//            ->orderBy('date_order DESC');
        $query
            ->andFilterWhere([ 'id'=> $this->id])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['email'=> $this->email])
            ->andFilterWhere(['phones'=> $this->phones])
            ->distinct();

        return $dataProvider;
    }

//    public function searchNewOrders($params)
//    {
//        $order = new TempOrders();
//        $order::setTable(TempOrders::SENT_BY_CUSTOMER);
//         $query =   $order::find();
//        $dataProvider = new ActiveDataProvider(['query' => $query,]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            return $dataProvider;
//        }
//
//        $query
//            ->andFilterWhere(['status' => TempOrders::SENT_BY_CUSTOMER,])
//            ->orderBy('date_order DESC');
//        $query
//            ->andFilterWhere([ 'id'=> $this->id])
//            ->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['name'=> $this->name])
//            ->andFilterWhere(['surename'=> $this->surename])
//            ->andFilterWhere(['email'=> $this->email])
//            ->andFilterWhere(['phone'=> $this->phone])
//            ->andFilterWhere(['phone2'=> $this->phone2])
//            ->distinct();
//
//        return $dataProvider;
//    }
//
//    public function searchAssembleOrders($params)
//    {
//        $order = new TempOrders();
//        $order::setTable(TempOrders::ORDER_ASSEMBLE);
//         $query =   $order::find();
//        $dataProvider = new ActiveDataProvider(['query' => $query,]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            return $dataProvider;
//        }
//
//        $query
//            ->andFilterWhere(['status' => TempOrders::ORDER_ASSEMBLE,])
//            ->orderBy('date_order DESC');
//        $query
//            ->andFilterWhere([ 'id'=> $this->id])
//            ->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['name'=> $this->name])
//            ->andFilterWhere(['surename'=> $this->surename])
//            ->andFilterWhere(['email'=> $this->email])
//            ->andFilterWhere(['phone'=> $this->phone])
//            ->andFilterWhere(['phone2'=> $this->phone2])
//            ->distinct();
//
//        return $dataProvider;
//    }
//
//    public function searchClosedOrders($params)
//    {
//        $order = new TempOrders();
//        $order::setTable(TempOrders::ORDER_CLOSED);
//         $query =   $order::find();
//        $dataProvider = new ActiveDataProvider(['query' => $query,]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            return $dataProvider;
//        }
//
//        $query
//            ->andFilterWhere(['status' => TempOrders::ORDER_CLOSED,])
//            ->orderBy('date_order DESC');
//        $query
//            ->andFilterWhere([ 'id'=> $this->id])
//            ->andFilterWhere(['like', 'address', $this->address])
//            ->andFilterWhere(['name'=> $this->name])
//            ->andFilterWhere(['surename'=> $this->surename])
//            ->andFilterWhere(['email'=> $this->email])
//            ->andFilterWhere(['phone'=> $this->phone])
//            ->andFilterWhere(['phone2'=> $this->phone2])
//            ->distinct();
//
//        return $dataProvider;
//    }


}