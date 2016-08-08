<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);


//    $menuItems[] = ['label' => Yii::t('msg/pages_info', 'Home'), 'url' => ['/site/index']];
    //    $menuItems[] = ['label' => Yii::t('msg/pages_info', 'Contact'), 'url' => ['/site/contact']];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Yii::t('msg/pages_info', 'Registration'),
            'url' => ['/site/reg']
        ];
        $menuItems[] = [
            'label' => Yii::t('msg/pages_info', 'Login'),
            'url' => ['/site/login']
        ];
    } else {
        $menuItems[] = [
            'label' => Yii::t('msg/pages_info', 'Profile'),
            'url' => ['/site/profile']
        ];

        $menuItems[] = [
            'label' => 'Обмен ресурсов',
            'url' => ['#'],
            'items' => [
                [
                    'label' => 'Купить ресурсы',
                    'url' => ['site/market-resources', 'action' => 'buy'],
                ],
                [
                    'label' => 'Продать ресурсы',
                    'url' => ['site/market-resources', 'action' => 'sell'],
                ],
            ]
        ];


        if (User::isUserAdmin(Yii::$app->user->identity->username)) {
            $menuItems[] = [
                'label' => Yii::t('msg/pages_info', 'User Admin'),
                'url' => ['/profile/index']
            ];
        }

        $menuItems[] = [
            'label' => Yii::t('msg/pages_info', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems
    ]);
    ?>
    <div class="navbar-text pull-right">
        <?=
        \lajax\languagepicker\widgets\LanguagePicker::widget([
            'skin' => \lajax\languagepicker\widgets\LanguagePicker::SKIN_DROPDOWN,
            'size' => \lajax\languagepicker\widgets\LanguagePicker::SIZE_SMALL
        ]);
        ?>
    </div>
    <? NavBar::end(); ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
