<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaskTracker */

$this->title = 'Создание задачи';
$this->params['breadcrumbs'][] = ['label' => 'Task Trackers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-tracker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('create_form', [
        'model' => $model,
    ]) ?>

</div>
