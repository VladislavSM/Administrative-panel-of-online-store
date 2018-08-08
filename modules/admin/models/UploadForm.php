<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 28.07.17
 * Time: 11:46
 */

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
//    public $imageFiles;

    public function rules()
    {
        return [
            [
                'imageFile',
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, tiff, gif,',
            ],


        ];
    }

    public function attributeLabels()
    {
        return [
            'imageFile' => 'Выбрать изображение для загрузки Превью',
        ];
    }



    public function upload()
    {
        if ($this->validate()&& !empty($this->imageFile)) {
            return $this->imageFile;
        } else {
            return false;
        }
    }

}