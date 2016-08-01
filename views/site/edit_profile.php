<?php
/**
 * Created by PhpStorm.
 * User: modkomi
 * Date: 31.07.2016
 * Time: 19:02
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('msg/pages_info', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->user)
        echo $form->field($model->user, 'email');
    ?>
    <?= $form->field($model, 'first_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
        <a href="<?=Url::toRoute(['profile'])?>"><?= Html::button('В профиль', ['class' => 'btn btn-default'])?></a>
    </div>
    <?php ActiveForm::end(); ?>


</div>

