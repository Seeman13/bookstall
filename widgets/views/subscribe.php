<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\Subscriber */
/* @var $form ActiveForm */

?>

<?php $form = ActiveForm::begin([
    'id' => 'subscription_form',
    'options' => [
        'class' => 'row g-3',
    ],
    'fieldConfig' => [
        'errorOptions' => [
            'tag'   => 'span',
            'class' => 'help-block help-block-error text-left',
        ]
    ]
]) ?>
    <div class="col-auto">
        <label for="subscribe" class="visually-hidden"><?= Yii::t('app', 'Subscription for new books') ?>></label>
        <?= $form->field($model, 'email', ['template' => '{label}{input}{error}'])->input('email', [
            'id' => 'subscribe',
            'maxlength' => true,
            'class' => 'form-control',
            'placeholder' => Yii::t('app', 'Subscription for new books'),
        ])->label(false) ?>
    </div>
    <div class="col-auto">
        <?= Html::submitButton('OK', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end() ?>
