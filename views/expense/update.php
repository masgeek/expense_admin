<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models_extended\EXPENSE_MODEL */

$this->title = 'Update Expense  Model: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Expense  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expense--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
