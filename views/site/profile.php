<?php

/* @var $this yii\web\View */
/* @var $profile */
/* @var $house */
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

    <h2>Запасы:</h2>

    <div class="col-md-6">
    <table class="table">
        <? foreach ($model as $item) : ?>
            <tr>
                <td><img style="width: 100px" src="<?= $item['resource']['link_image'] ?>"
                                              alt="<?= $item['resource']['resource_name'] ?>"></td>
                <td><?= $item['resource']['resource_name'] ?></td>
                <td><?= $item['amount'] ?> ед.</td>
            </tr>
        <? endforeach; ?>

    </table>
    </div>
</div>