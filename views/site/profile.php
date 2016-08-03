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

    <p class="bg-success" style="padding: 10px">
        Изменить данные:
        <a href="<?= Url::toRoute(['edit_profile']) ?>">Редактировать профиль</a>
    </p>

    <h2>Запасы:</h2>
    <ul>
        <? foreach ($model as $item) : ?>
            <li><?= $item['resource']['resource_name'] ?> : <?= $item['amount'] ?> ед.</li>
        <? endforeach; ?>
    </ul>

</div>
