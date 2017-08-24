<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models_extended\EXPENSE_MODEL */

$this->title = 'Create Expense';
$this->params['breadcrumbs'][] = ['label' => 'Expense  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
