<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\modules\admin\models\Items;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Items */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Товары'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= 'Просмотр : '.Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', ' РЕДАКТИРОВАТЬ ТОВАР '),
                    ['create', 'id' => $model->id], ['class' => 'btn btn-primary update_article_head']) ?>

        <?= Html::a(Yii::t('app', ' УДАЛИТЬ ТОВАР ??? '), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger delete_article',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
            ])
        ?>
    </p>
        <p class="manual"><strong>Cначала нажмите кнопку "Редактировать товар".
            Oтредактируйте необходимые пункты в
            появившейся таблице, а затем  нажмите кнопку "Редактировать".<br>
            Для удаления товара нажмите кнопку "Удалить товар".</strong><br>
    </p>
<!--    <div class="p-gal"><p>Галерея</p></div>-->
<!--    <section id="gal">-->
<!--    --><?php
//    if (is_array($images)):
//        foreach ($images as $image):
//    ?>
<!--            <div class="im">-->
<!--                <img class="admin-view-item-gal" src="/--><?//=$image; ?><!--">-->
<!--            </div>-->
<!--    --><?php
//        endforeach;
//    else:
//    ?>
<!--        <div id="im">-->
<!--            <img class="admin-view-item-gal" src="/--><?//=$images;?><!--">-->
<!--        </div>-->
<!--    --><?php
//    endif;
//    ?>
<!--    </section>-->

    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'class' => 'table table-striped table-bordered detail-view item-detal-view'
        ],
        'attributes' => [
            [
                'format' => 'html',
                'label' => 'Галерея',
                'value' => function($data) {
                    $content = '<div id="gal">';
                    foreach ($data->images as $image) {
                        $content .= '<img class="admin-view-item-gal" src="/' . $image . '">';
                    }
                    $content .= '</div>';
                    return $content;
                }
            ],
            [
                'label' => 'Превью',
                'format' => 'raw',
                'value' => function($data){
                    if (!isset($data->image)){
                        $data->image = 'image/not_image.gif';
                    }
                    return Html::img($data->image,[
                        'style' => 'width:10vw;'
                    ]);
                },
            ],
            'id',
            'title',
            [
                'format' => 'html',
                'attribute'=>'category',
                'value'=>nl2br($category['title']),
                'label'=>'Kатегория(категории)',
            ],
            'price',
            'image',
            'summury',
            'description:html',
        ],
    ]) ?>


<!--        <div class="p-gal"><p>Галерея</p></div>-->
<!--        --><?php
//        foreach ($images as  $image) {
//            echo '<div>
//                <img class="admin-view-item-gal" src="'.'/'.$image.' "
//        </div>'
//            ;
//        } ?>
<!---->




</div>


