<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Users;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="users-form">-->


    <?php $form = ActiveForm::begin(
        [
//            'id' => 'form-input-example',
            'options' => [
                'class' => 'form-horizontal col-lg-12 users-form',
                'role' => 'form'
//                'enctype' => 'multipart/form-data'
            ],
            ]
    ); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>



    <div class="form-group group-user">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Редактировать',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary update_user']) ?>
    </div>
    <?php ActiveForm::end(); ?>

<!--</div>-->
