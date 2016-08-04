<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

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
                <? if ($model) : ?>
                    <div class="col-md-8 work">
                        <h2>Тебе еще работать: <span>
                                    <?= $model->needs_time ?> минут.
                                </span></h2>
                        <p>
                            <br>
                            <a href="<?= Url::to(['site/work', 'id' => 3]) ?>">Перейти к детальной информации</a>
                        </p>
                    </div>
                <? endif; ?>

                <? if (!$model) : ?>
                    <div class="col-md-8 no-work">
                        <ul>
                            <li><a href="<?= Url::to(['site/work', 'id' => 2]) ?>">Хочу рубить лес</a></li>
                            <li><a href="<?= Url::to(['site/work', 'id' => 3]) ?>">Хочу добывать камень</a></li>
                            <li><a href="<?= Url::to(['site/work', 'id' => 4]) ?>">Хочу на охоту</a></li>
                            <li><a href="<?= Url::to(['site/work', 'id' => 5]) ?>">Хочу ловить рыбу</a></li>
                        </ul>
                    </div>
                <? endif ?>
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