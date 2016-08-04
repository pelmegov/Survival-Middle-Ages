<?php
/**
 * Created by PhpStorm.
 * User: modkomi
 * Date: 03.08.2016
 * Time: 21:13
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="site-about">

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
    <? else : ?>

        <h1>Вы еще не работаете!</h1>
        <p class="bg-info" style="padding: 10px">
            Готовы к работе? Приступаем?
        </p>
        <p class="bg-info" style="padding: 10px">
            Вы хотитие добывать : <b><?= $model->resource->resource_name ?></b>
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