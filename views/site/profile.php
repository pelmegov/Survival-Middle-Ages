<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('msg/pages_info', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?> <?= $model["first_name"] ?></h1>

    <p class="bg-success" style="padding: 10px">
        Изменить данные:
        <a href="<?=Url::toRoute(['edit_profile'])?>">Редактировать профиль</a>
    </p>

    <h3>Золота: <?= isset($model["gold"]) ? $model["gold"] : 0 ?> ед.</h3>

    <h2>Запасы:</h2>
    <ul>
        <li>Рыбы - <?= isset($model["fish"]) ? $model["fish"] : 0 ?> шт.</li>
        <li>Шкур животных - <?= isset($model["animal"]) ? $model["animal"] : 0 ?> шт.</li>
        <li>Древесины - <?= isset($model["wood"]) ? $model["wood"] : 0 ?> шт.</li>
        <li>Камня - <?= isset($model["stone"]) ? $model["stone"] : 0 ?> шт.</li>
    </ul>

</div>
