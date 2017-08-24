<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Income Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'type:ntext',
            'amount:currency',
            'place:ntext',
            'note:ntext',
            'cheque',
            'date:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
