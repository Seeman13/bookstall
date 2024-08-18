<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\AuthorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Authors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            [
                'attribute' => 'count_books',
                'contentOptions' => ['style' => 'text-align: center'],
                'content' => function($data) {
                    return $data->count_books;
                }
            ],
            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    return Html::tag('em', Yii::$app->formatter->asDate($data->created_at));
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'updated_at',
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    return Html::tag('em', Yii::$app->formatter->asDateTime($data->updated_at));
                },
                'format' => 'html'
            ]
        ]
    ]) ?>

    <?php Pjax::end() ?>

</div>
