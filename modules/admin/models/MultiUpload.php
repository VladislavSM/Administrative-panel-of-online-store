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

class MultiUpload extends Model
{
    /**
     * @var UploadedFile
     */
    public $uploadFiles;

    public function rules()
    {
        return [

            [['uploadFiles'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, tiff, gif,',
                'maxFiles' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'uploadFiles' => 'Выбрать изображения для загрузки в Галерею',
        ];
    }

//    public static function getFilePathList($path)
//    {
//        $filePathe = glob( $path.'/'.'*',GLOB_ONLYDIR);
//        $filePathe = array_combine($filePathe,$filePathe);
//        return $filePathe;
//    }

    public function upload()
    {
        if ($this->validate()&& !empty($this->uploadFiles)) {
            return $this->uploadFiles;
        } else {
            return false;
        }
    }


}