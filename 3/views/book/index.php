<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => "title",
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->title, ['book/view', 'id' => $model->id]);
                }
            ],
            [
                'attribute' => "author_id",
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->author->name, ['author/view', 'id' => $model->author_id]);
                }
            ],
        ],
    ]); ?>


</div>
