<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */

$this->title = Yii::t('msg/pages_info', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

    <?php
    if ($model->scenario === 'emailActivation'):
        ?>
        <!--        <i>*На указанный емайл будет отправлено письмо для активации аккаунта.</i>-->
        <?php
    endif;
    ?>

</div><!-- main-reg -->