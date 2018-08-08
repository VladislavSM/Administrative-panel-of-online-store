<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */


$this->title = 'Mottovoron';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
?>


<div class="users-view">

    <h1><?= Html::encode('Пользователь ( логин ): ' .$model->username) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'name',
            'surename',
            'email:email',
            'phone',
            'phone2',
            'dateOfRegistr',
            'status',
        ],
    ]) ?>
    <p>
        <?= Html::a('Редактировать пользователя', ['update', 'id' => $model->id], ['class' => 'btn btn-primary delete_article']) ?>
        <?= Html::a('Удалить пользователя', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger delete_article',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
