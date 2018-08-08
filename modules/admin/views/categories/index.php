<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Содержание раздела КАТЕГОРИИ :');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать новую КАТЕГОРИЮ ( или ПОДКАТЕГОРИЮ ).'), ['create?id='],
                           ['class' => 'btn btn-success create_article']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item item-index'],
        'itemView' => function ($model, $key, $index, $widget) {
            return 'Выбрать категорию для редактирования :'.' '. Html::a(Html::encode( $model->title ),
                                                      ['view', 'id' => $model->id]);
        },
    ]) ?>
</div>
