<?php
use yii\widgets\ActiveForm;
/* @var $modelUpload app\modules\admin\models\UploadForm */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($modelUpload, 'imageFile')->fileInput([]);
?>

<button>Submit</button>

<?php ActiveForm::end() ?>
