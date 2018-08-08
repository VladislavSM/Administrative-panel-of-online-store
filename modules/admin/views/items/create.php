<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Items */
/* @var $itemToCategory app\modules\admin\models\ItemToCategory */
/* @var $modelUpload app\modules\admin\models\UploadForm */
/* @var $path app\modules\admin\controllers\ItemsController->path */

$this->title = Yii::t('app', $message);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'itemToCategory' => $itemToCategory,
        'modelUpload' => $modelUpload,
        'modelMultiUpload' => $modelMultiUpload,
        'images'=>$model->images,
        'path' => $path,
//        'modelCategories'=> $modelCategories,
    ]) ?>

</div>
