<?php

namespace app\modules\admin\models;

use Yii;
use\app\modules\admin\models\UploadForm;
use yii\web\UploadedFile;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $summury
 * @property string $content
 * @property string $image
 */
class Article extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imagePath;
    public $path = 'image/articles';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['summury', 'content'], 'string'],
            [['name', 'image'], 'string', 'max' => 100],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название статьи',
            'summury' => 'Краткое описание статьи',
            'content' => 'Содержание статьи',
            'image' => 'Директория текущего изображения',
        ];
    }

    public function beforeSave($insert)
    {
//        $this->image = $this->getImagePath();
        return parent::beforeSave($insert);
    }

    public function getImagePath()
    {

    }
}
