<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' =>'user_id',
                'contentOptions'=>['style'=>'width: 100px;']
            ],
            'user.username',
            'user.email',
            'user.status',
            'nickname',
            [
                'attribute' => 'resources',
                'format' => 'html',
                'label' => 'Ресурсы',
                'value' => function ($model) {
                    $resources = "<table class='table table-bordered' style='margin-bottom: 2px'>";
                    foreach ($model->profileResources as $key => $resource) {
                        if ($key !== 0) {
                            $resources .= '<br>';
                        }
                        $resources .=
                            "<tr>"
                            . "<td style='padding: 2px 2px 2px 10px'>"
                            . $resource['resource']['resource_name']
                            . "</td>"
                            . "<td style='padding: 2px 2px 2px 10px'>"
                            . $resource['amount']
                            . "</td>"
                            ."</tr>";
                    }
                    $resources .= "</table>";
                    return $resources;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
