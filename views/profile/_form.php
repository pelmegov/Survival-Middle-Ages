<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $model app\models\ProfileResource */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model['user'], 'username')->textInput() ?>

    <?= $form->field($model['user'], 'email')->textInput() ?>

    <?= $form->field($model['user'], 'status')->textInput() ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <? foreach ($model['profileResources'] as $key => $resource) : ?>
        <?= $form->field($resource, "[$key]amount")->textInput()->label($resource->resource->resource_name) ?>
    <? endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
