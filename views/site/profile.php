<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('msg/pages_info', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h2>Твои запасы:</h2>
    <ul>
        <li>Рыбы - 4</li>
        <li>Шкур животных - 5</li>
        <li>Древесины - 15</li>
        <li>Камня - 30</li>
    </ul>

</div>
