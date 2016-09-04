<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskTracker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-tracker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'profile_id')->label(false)->hiddenInput(['value' => Yii::$app->user->id]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        "1" => "Задача открыта",
        "2" => "Задача на выполнении",
        "3" => "Задача закрыта",
        "4" => "Задача отклонена"
    ]); ?>

    <?= $form->field($model, 'created_at')->label(false)->hiddenInput(['value' => time()]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
