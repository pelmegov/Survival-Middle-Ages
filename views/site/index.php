<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <section class="gg-main">

        <? if (!Yii::$app->user->isGuest) : ?>
            <div class="row">
                <div class="col-md-4">
                    <img class="mainimg" src="http://commando.com.ua/uploads/posts/2012-07/1342331264_0076.jpg"
                         alt="<?= Yii::$app->name ?>">

                    <h1 class="imgh1"><?= Yii::$app->name ?></h1>
                </div>
                <div class="col-md-8 work"><p>Тебе еще работать: <span>1 час 20 минут</span></p></div>
            </div>
            <div class="col-md-12 no-work">
                <ul>
                    <li><a href="#">Хочу ловить рыбу</a></li>
                    <li><a href="#">Хочу на охоту</a></li>
                    <li><a href="#">Хочу рубить лес</a></li>
                    <li><a href="#">Хочу добывать камень</a></li>
                </ul>
            </div>

        <? else : ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>Добро пожаловать в игру <?= Yii::$app->name ?></h2>

                    <p>Пожалуйста, пройдите регистрацию чтобы получить доступ к игре.</p>
                    <p>Или войдите, если вы проходили регистрацию ранее.</p>
                </div>
            </div>
        <? endif; ?>
    </section>
</div>
