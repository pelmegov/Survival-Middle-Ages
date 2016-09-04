<?php
/**
 * Created by PhpStorm.
 * User: modkomi
 * Date: 03.08.2016
 * Time: 21:13
 */

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Работа";
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-about">


    <?= Yii::$app->session->getFlash('endWork'); ?>

    <? if ($model->needs_time > 0) : ?>
        <h1>Вы уже работаете!</h1>

        <p class="bg-info" style="padding: 10px">
            Вы добываете : <b><?= $model->resource->resource_name ?></b>
        </p>
        <p class="bg-info" style="padding: 10px">
            Отработав, вы получите :
            <b><?= $model->resource->amount ?> <?= $model->resource->resource_name ?></b>
        </p>
        <p class="bg-warning" style="padding: 10px">
            Вам осталось работать : <b><?= $model->needs_time ?> минут</b>
        </p>

        <? if ($model->resource->link_bg_image) : ?>
            <div class="row">
                <div class="col-md-12">
                    <img style="width: 100%" src="<?= $model->resource->link_bg_image ?>" alt="<?= $model->resource->resource_name ?>">
                </div>
            </div>
        <? endif; ?>

    <? else : ?>

        <h1>Вы еще не работаете!</h1>
        <p class="bg-info" style="padding: 10px">
            Готовы к работе? Приступаем?
        </p>
        <p class="bg-info" style="padding: 10px">
            Вы хотите добывать : <b><?= $model->resource->resource_name ?></b>
        </p>
        <p class="bg-info" style="padding: 10px">
            Вы будете работать : <b><?= $model->resource->needs_time ?> минут</b>
        </p>
        <p class="bg-info" style="padding: 10px">
            Отработав это время, вы получите :
            <b><?= $model->resource->amount ?> <?= $model->resource->resource_name ?></b>
        </p>
        <h3>
            <a href="<?= Url::to(['site/work', 'yes' => '1', 'id' => $model->resource_id]) ?>">Начать работать!</a>
        </h3>

    <? endif; ?>

</div>