<?php

namespace app\modules\admin\models;

use Yii;
use\app\modules\admin\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parentId
 * @property string $title
 * @property string $summury
 * @property string $category_without_items
 * @property string $image
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $path = 'image/categories';
    public $parentName;

    const DEFAULT_IMAGE_NAME = 'ico.png';


//    public $imagePath;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['category_without_items', 'string'],
            [['summury'], 'string'],
            [['title', 'image'], 'string', 'max' => 100],
            [['parentId'], 'integer', 'max'=> 12],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentId' => 'Родительская категория :',
            'parentName' => 'Родительская категория :',
            'title' => 'Название категории',
            'summury' => 'Краткое описание категории',
            'category_without_items' => 'Описание для категорий без товара.',
            'image' => 'Директория текущего изображения',


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
    }


    public static function getCategoriesList()
    {
        $categories = Categories::find()->select(['id', 'title'])->all();
        return ArrayHelper::map($categories, 'id', 'title');
    }



    public function afterDelete()
    {
        parent::afterDelete();

        FileHelper::removeDirectory($this->path.DIRECTORY_SEPARATOR.$this->id);

    }




}


//SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name='category';

//    public function findNewId(){
//        return Yii::$app->db->createCommand
//                    ('SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name=\'category\'')
//            ->queryScalar();
//    }