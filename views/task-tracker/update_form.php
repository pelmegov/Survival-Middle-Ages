<?php

use app\models\Profile;
use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaskTracker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-tracker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        "1" => "Задача открыта",
        "2" => "Задача на выполнении",
        "3" => "Задача закрыта",
        "4" => "Задача отклонена"
    ]); ?>

    <?
    $admins = User::find()->where(["role" => "20"])->all();

    foreach ($admins as $admin) {
        $administrators[] = Profile::findOne(["user_id" => $admin->id]);
    }

    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($administrators, 'user_id', 'nickname');
    $params = [
        'prompt' => 'Укажите ответственного'
    ];
    echo $form->field($model, 'responsible')->dropDownList($items, $params);
    ?>

    <?= $form->field($model, 'created_at')->label(false)->hiddenInput(['value' => time()]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
