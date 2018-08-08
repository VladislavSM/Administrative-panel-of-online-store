<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode('Пользователи.') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table  table-bordered table-condensed table-hover user-table'
        ],

        'columns' => [

            'id',
            'username',
            'name',
            'surename',
             'email:email',
             'phone',
             'phone2',
             'status',
             'dateOfRegistr',

           ['class' => 'yii\grid\ActionColumn',
               'header'=>'Действия',
               ],
        ],
    ]); ?>
</div>
