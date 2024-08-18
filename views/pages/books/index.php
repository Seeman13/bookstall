<?php

use yii\helpers\{Html, Url};
use yii\grid\{ActionColumn, GridView};
use yii\widgets\Pjax;

use app\models\Book;
use app\widgets\SubscribeWidget;

/** @var yii\web\View $this */
/** @var app\models\BookSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row text-muted">
        <div class="col-md-3 text-center text-md-start">
            <?= Html::a(Yii::t('app', 'Create Book'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-9 text-center text-md-end">
            <?= SubscribeWidget::widget() ?>
        </div>
    </div>

    <?php Pjax::begin() ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'release',
            'description:ntext',
            'isbn',
            //'image',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Book $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ]
        ]
    ]) ?>

    <?php Pjax::end() ?>

</div>
