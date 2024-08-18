<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var app\models\Author $authors */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

<!--    --><?php //= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php
    $model->list_authors = $model->authors;
    echo $form->field($model, 'list_authors', [
        'inputOptions' => [
            'class' => 'selectpicker '
        ]
    ])->widget(Select2::class, [
        'data' => \yii\helpers\ArrayHelper::map($authors, 'id', 'fullname'),
        'language' => 'ru',
        'options' => [
            'class' => 'select2-select',
            'placeholder' => '- выбирите авторов -',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
