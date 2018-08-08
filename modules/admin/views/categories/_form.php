

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */
/* @var $modelUpload app\modules\admin\models\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>
<?php //$this->head() ?>



<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="this_article_image_field"> <?= Html::img($model['image'])?>
        <p> Teкущее изображение.</p>
    </div>


    <?= $form->field($modelUpload, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'parentId')->dropDownList($model::getCategoriesList(),
        ['prompt' => 'Выберите родительскую категорию (ПРИ создании подкатегории; 
         ИЛИ оставьте поле пустым для главной категории):']) ?>

    <?= $form->field($model, 'summury')->textInput() ?>

    <?= $form->field($model, 'category_without_items')->textarea(['rows' => 11]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('app', 'Cоздать новую категорию (подкатегорию).') :
            Yii::t('app', 'Редактировать'),
            ['class' => $model->isNewRecord ? 'btn btn-success create_article' : 'btn btn-primary update_article']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>


<?php

//echo \vova07\imperavi\Widget::widget([
//    'name' => 'redactor',
//
//    'settings' => [
//
//        'lang' => 'ru',
//        'minHeight' => 200,
////        'pastePlainText' => true,
////        'buttonSource' => true,
//        'plugins' => [
//            'clips',
////            'counter',
////            'textdirection',
////            'fullscreen',
////            'inlinestyle'
//        ]
//    ]
//]);


echo \vova07\imperavi\Widget::widget([
    'selector' => '#categories-category_without_items',
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 100,

        'plugins' => [
            'clips',
            'fullscreen',
            'table'
        ]
    ]
]);?>

