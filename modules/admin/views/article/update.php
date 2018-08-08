<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */
/* @var $modelUpload app\modules\admin\models\UploadForm */
/* @var $path app\modules\admin\controllers\ArticleController->path */


$this->title = Yii::t('app', 'Редактировать статью : ', [
    'modelClass' => 'Article',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload' => $modelUpload,
        'path' => $path

    ]) ?>

</div>
