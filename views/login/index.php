<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Login  Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Login  Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name:ntext',
            'pin',
            'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
