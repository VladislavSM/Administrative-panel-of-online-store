<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1><?= 'Просмотр статьи : '.Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', ' РЕДАКТИРОВАТЬ СТАТЬЮ '),
                    ['create', 'id' => $model->id], ['class' => 'btn btn-primary update_article_head']) ?>

        <?= Html::a(Yii::t('app', ' УДАЛИТЬ СТАТЬЮ ??? '), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger delete_article',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
            ])
        ?>
    </p>
        <p class="manual"><strong>Cначала нажмите кнопку "Редактировать статью".
            Oтредактируйте необходимые пункты в
            появившейся таблице, а затем  нажмите кнопку "Редактировать".<br>
            Для удаления статьи нажмите кнопку "Удалить статью".</strong>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'image',
            'image:image:Текущее изображение',
            'summury:ntext',
            'content:ntext',
        ],
    ]) ?>

</div>
