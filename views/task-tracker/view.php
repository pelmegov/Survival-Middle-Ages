<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TaskTracker */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Task Trackers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-tracker-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?
    switch ($model['status']) {
        case 1:
            $status = "Задача открыта";
            break;
        case 2:
            $status = "Задача на выполнении";
            break;
        case 3:
            $status = "Задача закрыта";
            break;
        case 4:
            $status = "Задача отклонена";
            break;
        default:
            $status = "Неизвестный статус";
            break;
    }

    $administrator = "Неизвестный юзер";
    foreach ($admins as $admin) {
        if ($model->responsible == $admin->user_id) {
            $administrator = $admin->nickname;
        }
    }
    ?>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_id',
            'title',
            'text:ntext',
            [
                'attribute' => 'status',
                'value' => $status
            ],
            [
                'attribute' => 'responsible',
                'value' => $administrator,
            ],
            'created_at:datetime',
        ],
    ]) ?>

</div>
