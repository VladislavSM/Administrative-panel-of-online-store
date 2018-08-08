

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Items */
/* @var $itemToCategory app\modules\admin\models\ItemToCategory */
/* @var $modelUpload app\modules\admin\models\UploadForm */
/* @var $modelMultiUpload app\modules\admin\models\MultiUpload */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

//$itemToCategory->delete =
//    $itemToCategory->getCategoryId($model->id);
//$imagess = array_combine($images,$images);
//var_dump($imagess);die;
  ?>


<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <div class="this_article_image_field"> <?= Html::img($model['image'])?>
        <p> Teкущее Превью.</p>
    </div>


    <?= $form->field($modelUpload, 'imageFile')->fileInput() ?>

    <?= $form->field($modelMultiUpload, 'uploadFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="form-group field-items-imgdelete">
        <label class="control-label" for="items-imgdelete">Выберать изображения для удаления из Галереи</label>
        <input type="hidden" name="Items[imgdelete]" value="">

        <?php
        foreach ($images as $key=>$value){
            echo'<label><input type="checkbox" name="Items[imgdelete][]" value="'. $value .'">
                     <img  style="width: 2vw" src="'.'/'.$value.'"<i> '.$value.'</i></label>';
        }
        ?>

        <div class="help-block"></div>
    </div>



    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <span class="item-checkbox">Выберите дополнительно категорию(категории)для товара :</span>
    <?= $form->field($itemToCategory, 'categoryId')->checkboxList($itemToCategory::excludeCategoryId($model->id)) ?>

    <span class="item-checkbox">Выберите категорию(категории) из которой Вы хотите удалить товар :</span>
    <?= $form->field($itemToCategory, 'delete')->checkboxList($itemToCategory::getCategoryId($model->id)) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'summury')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 11]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ?
            Yii::t('app', 'Добавить новый товар.') :
            Yii::t('app', 'Редактировать товар.'),
            ['class' => $model->isNewRecord ? 'btn btn-success create_article' : 'btn btn-primary update_article']) ?>
    </div>



    <?php ActiveForm::end(); ?>



</div>


<?php

echo \vova07\imperavi\Widget::widget([
    'selector' => '#items-description',
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

<!--    <section id="to-delete">-->
<!--        --><?php
//        //    var_dump($images);die;
//        if (is_array($images)) {
//            foreach ($images as $image) {
//                echo '<div id="im-del">
//                <img class="admin-to-delete" src="' . '/' . $image . ' "
//
//
//                    </div>';
//            }
//        }else{
//            echo '<div id="im-del">
//                <img class="admin-to-delete" src="' . '/' . $images . ' "
//                                <figcaption> '. $images.'</figcaption>
//
//                    </div>';
//
//        }
//        ?><!--</section>-->