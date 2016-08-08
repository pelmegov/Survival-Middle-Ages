<?php

/* @var $this yii\web\View */
/* @var $profile */
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('msg/pages_info', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?> <?= $profile['nickname']; ?></h1>

    <?= Yii::$app->session->getFlash('successProfileUpdate'); ?>

    <p class="bg-success" style="padding: 10px">
        Изменить данные:
        <a href="<?= Url::toRoute(['edit-profile']) ?>">Редактировать профиль</a>
    </p>

    <h2>Обмен ресурсов:</h2>
    <div class="row">
        <div class="col-md-4">
            <table class="table">
                <tr>
                    <td><a href="<?= Url::to(['site/market-resources', 'action' => 'buy']) ?>">Купить ресурсы</a></td>
                    <td><a href="<?= Url::to(['site/market-resources', 'action' => 'sell']) ?>">Продать ресурсы</a></td>
                </tr>
            </table>
        </div>
    </div>

    <h2>Запасы:</h2>
    <ul>
        <? foreach ($model as $item) : ?>
            <li><?= $item['resource']['resource_name'] ?> : <?= $item['amount'] ?> ед.</li>
        <? endforeach; ?>
    </ul>

</div>
