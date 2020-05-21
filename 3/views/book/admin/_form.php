<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
/* @var $authors app\models\Author */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_id')->dropDownList($authors) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
