<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models_extended\INCOME_MODEL */

$this->title = 'Create Income  Model';
$this->params['breadcrumbs'][] = ['label' => 'Income  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
