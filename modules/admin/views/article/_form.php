

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */
/* @var $modelUpload app\modules\admin\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="this_article_image_field"> <?= Html::img($model['image'])?>
        <p> Teкущее изображение.</p>
    </div>

    <?= $form->field($modelUpload, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'summury')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 11]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('app', 'Cоздать новую статью.') :
            Yii::t('app', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success create_article' : 'btn btn-primary update_article']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php


echo \vova07\imperavi\Widget::widget([
    'selector' => '#article-summury',
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 100,

        'plugins' => [
            'fontsize',
            'fontfamily',
            'fontcolor',
            'textdirection',
            'clips',
            'fullscreen',
            'table',

        ]
    ]
]);echo \vova07\imperavi\Widget::widget([
    'selector' => '#article-content',
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 100,

        'plugins' => [
            'fontsize',
            'fontfamily',
            'fontcolor',
            'textdirection',
            'clips',
            'fullscreen',
            'table',

        ]
    ]
]);

?>
