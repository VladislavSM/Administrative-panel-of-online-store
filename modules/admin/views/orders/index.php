<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\modules\admin\models\Orders;
use app\modules\admin\models\OrdersSearch;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mottovoron';

// Assign empty string as default class for li
$index = $assembleOrders = $closedOrders = '';

$active = 'class="active-admin-btn"';
switch (Yii::$app->controller->action->id) {
    case 'index':
        $index = $active;
        break;
    case 'assemble-orders':
        $assembleOrders = $active;
        break;
    case 'closed-orders':
        $closedOrders = $active;
        break;
}
?>
<div class="users-index">

    <ul class="nav-pills nav admin-view-orders ">
    <li <?= $index; ?>>
        <a class="btn btn-default" href="/admin/orders">Новые заказы</a>
    </li>
    <li <?= $assembleOrders; ?>>
        <a class="btn btn-default  " href="/admin/orders/assemble-orders">Заказы принятые в работу</a>
    </li>
    <li <?= $closedOrders; ?>>
        <a class="btn btn-default   " href="/admin/orders/closed-orders">Доставленные заказы</a>
    </li>

    </ul><br><br>

    <?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
        <?php foreach($messages as $message): ?>
            <div id="adm-message" class=" alert alert-<?= $type ?> " role="alert"><?= $message ?></div>
        <?php endforeach ?>
    <?php endforeach ?>

<?php
    echo GridView::widget([

        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table  table-bordered table-condensed table-hover table-responsive user-table'
        ],
        'columns' => [

            'id',
            ['attribute'=>'userId',
             'content'=>function($data){
        if ($data->userStatus == \app\modules\admin\models\Users::STATUS_UNREGISTERED_CUSTOMER){
            $result = 'ГОСТЬ';
        }else{
            $result = 'Зарегистрированый пользователь';
        }
                return $result;
            }],

            'fullname',
            'email',
            [
                'attribute' => 'phones',
                'format' => 'html',
                'content' => function($data) {
                    return nl2br($data->phones);
                },
            ],
            'address',
            'date_order',

            ['attribute'=>'view',
                'content'=>function($data){
      return '<a class="" href="/admin/orders/view?id='.$data->id.'" ><span class="glyphicon glyphicon-eye-open"></span> </a>';
                }

            ],

//            ['class' => 'yii\grid\ActionColumn',
//                'header'=>'Действия',
//
//                'template' => '{view} {link}',
//                'buttons' => [
//                    'view' => function ($url) {

//                            $url = '/admin/items/view?id='.->id.' ';
//                        return Html::a(

//                            '<span class="glyphicon glyphicon-pencil" ></span>',

//                            $url,['title'=>'view','aria-label'=>'view']);
//                    },
//                   'link' => function ($url,$model,$key) {
//                       return Html::a( $url);
//                   },
//                ],
//            ],
        ],

    ]); ?>
</div>
