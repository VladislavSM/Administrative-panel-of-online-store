<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 21.09.17
 * Time: 10:15
 */

namespace app\modules\admin\models;

use Yii;
use\app\modules\admin\models\UploadForm;
use\app\modules\admin\models\MultiUpload;
use yii\db\BaseActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\helpers\FileHelper;

class Items extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $uploadFiles;
    public $path = 'image/items';
    public $category;
    public $categoryId;
    public $imgdelete;

    public $item;
    public $images;

    const DEFAULT_IMAGE_NAME = 'ico.png';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summury','description'], 'string'],
            [['title', 'image'], 'string', 'max' => 100],
            [['id','price'], 'integer'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Полное описание товара :',
            'title' => 'Название товара',
            'price' => 'Цена товара',
            'summury' => 'Краткое описание товара',
            'image' => 'Директория Превью',
            'category'=>' Категории товара :',
            'imgdelete'  => 'Выберать изображения для удаления из Галереи',


        ];
    }



    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($this->imageFile) {

            $path = $this->path . DIRECTORY_SEPARATOR . $this->id;


            if (!is_dir($path)) {
                FileHelper::createDirectory($path,0775,true);
            }

            $this->imageFile->saveAs(
                $path . DIRECTORY_SEPARATOR . self::DEFAULT_IMAGE_NAME
            );

            $this->image = DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . self::DEFAULT_IMAGE_NAME;

            $this->updateAttributes(['image']);
        }

        if ($this->uploadFiles) {
            $path = $this->path . DIRECTORY_SEPARATOR . $this->id;
            if (!is_dir($path)) {
                FileHelper::createDirectory($path,0775,true);
            }
            $multiUpload = new MultiUpload();
            $multiUpload->uploadFiles=$this->uploadFiles;
            foreach ($multiUpload->uploadFiles as $multiUpload->uploadFiles) {
                $multiUpload->uploadFiles
                    ->saveAs($path . DIRECTORY_SEPARATOR . $multiUpload->uploadFiles->baseName . '.' .
                                  $multiUpload->uploadFiles->extension);
            }
        }

        $this->item = Yii::$app->request->post();
        if (!empty($this->item['Items']['imgdelete'])){
            foreach ($this->item['Items']['imgdelete'] as $imgDelete){
//                var_dump($imgDelete);die;
                unlink($imgDelete);
            }
        }

        if(!empty($this->item['ItemToCategory']['categoryId'])) {
            foreach ($this->item['ItemToCategory']['categoryId'] as $categoryId) {
                Yii::$app->db->createCommand()->batchInsert('itemToCategory', ['itemId', 'categoryId'], [
                    [$this->id, $categoryId],
                ])->execute();
            }
        }
        if(!empty($this->item['ItemToCategory']['delete'])) {
            foreach ($this->item['ItemToCategory']['delete'] as $delete) {
                Yii::$app->db->createCommand()
                    ->delete('itemToCategory', 'itemId = '.$this->id.' and categoryId = '.$delete.'' )
                    ->execute();
            }

        }

    }


    public static function getCategoriesList()
    {
        $categories = Categories::find()
            ->select(['id', 'title'])
            ->all();

        return ArrayHelper::map($categories, 'id', 'title');
    }



    public static function getCategoryName($id)
    {
        $category = Categories::find()->select([
            'category.id',
            'GROUP_CONCAT(category.`title` SEPARATOR "  \n") AS `title`'
        ])

        ->innerJoin('itemToCategory ito','ito.categoryId=category.id')
        ->innerJoin('item i','i.id=ito.itemId')
        ->where('i.id=:id',[':id'=>$id])
        ->groupBy('i.id')
        ->one();
//        var_dump($category);die;
        return $category;

    }

    public static function getCategoryId($id)
    {
        $category = Categories::find()->select([
//            'category.id',
            'category.title'
        ])

        ->innerJoin('itemToCategory ito','ito.categoryId=category.id')
        ->innerJoin('item i','i.id=ito.itemId')
        ->where('i.id=:id',[':id'=>$id])
//        ->groupBy('i.id')
        ->all();

        return $category;

    }
    public function setCategory($id){
        $this->category = self::getCategoryName($id);
//        var_dump($this->category);die;
        return $this->category;
    }



    public function afterDelete()
    {
        parent::afterDelete();

        FileHelper::removeDirectory($this->path.DIRECTORY_SEPARATOR.$this->id);

    }

    public function findItem($id)
    {
        $this->item = (new \yii\db\Query())
            ->select(['id', 'title', 'price', 'description', 'image'])
            ->from('item')
            ->where('id=:id', [':id' => $id])
            ->one();
        return $this->item;

    }



    public function findPath($path){

        $this->path = $path . $this->item['id'];

        return $this->path;
    }



    public function viewImage() {

        if (!is_dir($this->path)) {
            $this->path = 'image/';
            $this->images = $this->path.'not_image.gif';

        }else {

            $this->images = FileHelper::findFiles($this->path);
        }

        return $this->images;
    }



}