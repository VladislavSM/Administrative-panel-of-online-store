<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Categories */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= 'Просмотр категории : '.Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', ' РЕДАКТИРОВАТЬ КАТЕГОРИЮ '),
                    ['create', 'id' => $model->id], ['class' => 'btn btn-primary update_article_head']) ?>

        <?= Html::a(Yii::t('app', ' УДАЛИТЬ КАТЕГОРИЮ ??? '), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger delete_article',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
            ])
        ?>
    </p>
        <p class="manual"><strong>Cначала нажмите кнопку "Редактировать категорию".
            Oтредактируйте необходимые пункты в
            появившейся таблице, а затем  нажмите кнопку "Редактировать".<br>
            Для удаления категории нажмите кнопку "Удалить категорию".</strong>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'title',
            'parentName',
            'image',
            'image:image:Текущее изображение',
            'summury',
            'category_without_items',


        ],
    ]) ?>
    <!--           <div class="this_article_image"> --><?//= Html::img($model['image'])?><!--<p> Teкущее изображение.</p>-->
    <!--           </div>-->

</div>
