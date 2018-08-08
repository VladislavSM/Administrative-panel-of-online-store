<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\admin\models\Items;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mottovoron';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode('Товары MottoVoron.') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Добавить новый товар.'), ['create?id='],
            ['class' => 'btn btn-success create_item']) ?>
    </p>


    <?=  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table  table-bordered table-condensed table-hover table-responsive user-table'
        ],

        'columns' => [

            'id',
            'title',
            [
                'attribute'=>'category',
                'label'=>'Kатегория',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    $result = Items::getCategoryName($data->id);
//                    var_dump($result);die;
                    return $result['title'];
                },
                'filter' => \app\modules\admin\models\Categories::getCategoriesList()
            ],

            'price',
             'image',
            [
                'label' => 'Превью',
                'format' => 'raw',
                'value' => function($data){
                    return Html::img(Url::toRoute($data->image),[
                        'style' => 'width:2vw;'
                    ]);
                },
            ],

           ['class' => 'yii\grid\ActionColumn',
               'header'=>'Действия',

               'template' => '{view} {create} {delete}{link}',
               'buttons' => [
                   'create' => function ($url,$model) {
                       return Html::a(

                           '<span class="glyphicon glyphicon-pencil" ></span>',

                           $url,['title'=>'update','aria-label'=>'updete']);
                   },
//                   'link' => function ($url,$model,$key) {
//                       return Html::a( $url);
//                   },
               ],
           ],
               ],

    ]); ?>
</div>
