<?php

/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 07.07.17
 * Time: 16:17
 */
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;

class AdminController extends Controller
{
    public $layout = './adminlayout';
    public $defaultAction = 'admin';


    public function actionAdmin(){
        if (Yii::$app->user->isGuest) {
            return $this->goBack('/site/index');
        }else{
            return $this->render('./admin',
            ['adminName' => Yii::$app->user->identity->username,
            ]);
        }

    }


}