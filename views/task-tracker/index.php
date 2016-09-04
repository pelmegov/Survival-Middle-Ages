<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $admins */
/* @var $searchModel app\models\TaskTrackerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('msg/pages_info', 'Task Tracker');;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-tracker-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создание задачи', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'profile.nickname',
            [
                'attribute' => 'responsible',
                'value' => function ($model) use ($admins) {

                    foreach ($admins as $admin) {
                        if ($model->responsible == $admin->user_id) {
                            return $admin->nickname;
                        }
                    }

                    return "Неизвестный юзер";
                },
            ],
            'title',
            [
                'attribute' => 'text',
                'value' => function ($model) {
                    return StringHelper::truncate($model->text, 100);
                }
            ],
            [
                'attribute' => 'status',
                'filter' => [
                    "1" => "Задача открыта",
                    "2" => "Задача на выполнении",
                    "3" => "Задача закрыта",
                    "4" => "Задача отклонена"
                ],
                'value' => function ($model) {
                    switch ($model['status']) {
                        case 1:
                            return "Задача открыта";
                            break;
                        case 2:
                            return "Задача на выполнении";
                            break;
                        case 3:
                            return "Задача закрыта";
                            break;
                        case 4:
                            return "Задача отклонена";
                            break;
                    }
                    return "Неизвестный статус";
                },
            ],
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
