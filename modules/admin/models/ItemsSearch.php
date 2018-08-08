<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.09.17
 * Time: 10:46
 */

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Items;

class ItemsSearch extends Items
{
 public $category;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['title','category', 'summury', 'description', 'image',], 'safe'],
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
        $query = Items::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item.id' => $this->id,

        ])
            ->orderBy('item.id');

        $query
            ->innerjoin('itemToCategory','item.id=itemToCategory.itemId')
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['categoryId' => $this->category])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'summury', $this->summury])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->distinct();
//        die($query->createCommand()->getRawSql());
        return $dataProvider;
    }

}