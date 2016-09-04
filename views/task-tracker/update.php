<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaskTracker */

$this->title = 'Update Task Tracker: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Task Trackers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-tracker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('update_form', [
        'model' => $model,
    ]) ?>

</div>
