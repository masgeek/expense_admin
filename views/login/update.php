<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models_extended\LOGIN_MODEL */

$this->title = 'Update Login  Model: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Login  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="login--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
