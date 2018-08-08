<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="icon" href="mottoicon.ico" >
    <link href="/assets/852cbee8/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/f2363596/redactor.css" rel="stylesheet">
    <link href="/assets/f2363596/plugins/clips/clips.css" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php $this->beginBody() ?>
<div class="nav-admin">
<?php
//    NavBar::begin(
//            [
//        'brandLabel' => 'MottoVoron',
//        'brandUrl' => Yii::$app->homeUrl,
//        'options' => [
//            'class' => 'navbar-inverse navbar-fixed-top  ',
//        ],
//    ]
//);
    echo Nav::widget([
        'options' => ['class' => 'nav navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site']],
//            ['label' => 'О нас', 'url' => ['/site/about']],
//            ['label' => 'Написать нам', 'url' => ['/site/contact']],
//            ['label' => 'Create account', 'url' => ['/site/reg']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
//    NavBar::end();
?>
</div>
<div class="wrap">



<div class="menu-wrap">
<div class="admin-menu">
    <img class="admin-logo" src="/image/admin_logo.png"><br>
<!--    <p class="brend"> MottoVoron.</p><br>-->
    <p class="p"> Mеню Администратора</p>
    <ul class="nav  nav-stacked">
        <li><a href="/admin/users/index"><span class="glyphicon glyphicon-user admin-menu-linc"> </span>  Пользователи. </a></li>
        <li><a href="/admin/article"><span class="glyphicon glyphicon-file admin-menu-linc"> </span>   Статьи. </a></li>
        <li><a href="/admin/categories"><span class="glyphicon glyphicon-th-list admin-menu-linc"> </span>   Категории. </a></li>
        <li><a href="/admin/items"><span class="glyphicon glyphicon-barcode admin-menu-linc"> </span>   Товары. </a></li>
        <li><a href="/admin/orders"><span class="glyphicon glyphicon-shopping-cart admin-menu-linc"> </span>   Заказы. </a></li>

    </ul>
</div>
</div>


<div class="content_admin">



    <?= $content ?>

</div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>