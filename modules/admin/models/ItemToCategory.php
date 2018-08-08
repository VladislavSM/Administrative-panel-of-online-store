<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 25.09.17
 * Time: 16:05
 */

namespace app\modules\admin\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ItemToCategory extends ActiveRecord
{
//    public $itemId;
//    public $categoryId;
    public $categoryId;
    public $delete;
    public static function tableName()
    {
        return 'itemToCategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','itemId','categoryId'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'ID товара :',
            'categoryId' => 'Категории :',
            'delete' => 'Удалить товар из категории :',
        ];
    }

    public static function getCategoryId($id)
    {
        $category = (new \yii\db\Query())
            ->select(['itemToCategory.categoryId', 'c.title'])
            ->from('itemToCategory')
            ->innerJoin('category c','itemToCategory.categoryId=c.id')
            ->innerJoin('item i','i.id=itemToCategory.itemId')
            ->where('i.id=:id',[':id'=>$id])
            ->all();
             return ArrayHelper::map($category, 'categoryId', 'title');

    }

    public static function excludeCategoryId($id)
    {
        $category = self::getCategoryId($id);
        $allCategories = Items::getCategoriesList();
        $newCategories  = array_diff_assoc($allCategories,$category);
//        var_dump($newCategories);die;
        return $newCategories;

    }
        public function setCategory($id){
        $this->categoryId = self::getCategoryId($id);
//        var_dump($this->category);die;
        return $this->categoryId;
    }
}





//public static function findCategoryForUpdateId($itemId){
//        return (new \yii\db\Query())
//            ->select('id')
//            ->from('itemToCategory')
//            ->Where('itemId=:itemId', [':itemId' => $itemId])
//            ->all();
//    }


//    public function setCategory($id){
//        $this->categoryId = self::getCategoryId($id);
//        var_dump($this->category);die;
//        return $this->categoryId;
//    }
