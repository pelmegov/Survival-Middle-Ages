<?php
/**
 * Created by PhpStorm.
 * User: modkomi
 * Date: 03.08.2016
 * Time: 21:13
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;


$this->title = "Рынок Ресурсов";
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-about">

    <div class="row">
        <div class="col-md-4">
            <? if ($action == "sell") : ?>

                <?php $form = ActiveForm::begin(); ?>

                <? $resources =
                    \app\models\Resource::find()
                        ->where('resource.resource_id>1')
                        ->joinWith("profileResources")
                        ->andWhere(["profile_resource.user_id" => Yii::$app->user->id])
                        ->andWhere("profile_resource.amount>0")
                        ->all();
//        echo "<pre>";
//        print_r($resources);
//        echo "</pre>";

                $js = new \yii\web\JsExpression("
          var url='" . Url::to(['/site/get-cost']) . "';
          $(document).on('change','#sellform-id',function(){
             var id = $(this).val();
                $.post(url,{id:id},function(data){
                      if(data){
                          $('#you_have').text(data);
                      }
                });

                var url2='" . Url::to(['/site/get-sum']) . "';
                var col= $('#sellform-amount').val();
                var prod_id = $('#sellform-id').val();

                console.log('col='+col);
                console.log('prod_id='+prod_id);

                $.post(url2,{col:col, prod_id:prod_id},function(data){
                      if(data){
                          $('#cost-sum').text(data);
                      }
                });

          })");
                $this->registerJs($js);
                ?>

                <?
                $items = ArrayHelper::map($resources, 'resource_id', 'resource_name');
                $params = [
                    'prompt' => 'Выберите ресурс'
                ];
                echo $form->field($model, 'id')->dropDownList($items, $params); ?>

                <?= $form->field($model, 'amount')->textInput(
                    [
                        'onchange' => new \yii\web\JsExpression("
                    (function(){
                        var url='" . Url::to(['/site/get-sum']) . "';
                        var col= $('#sellform-amount').val();
                        var prod_id = $('#sellform-id').val();

                        console.log('col='+col);
                        console.log('prod_id='+prod_id);

                        $.post(url,{col:col, prod_id:prod_id},function(data){
                              if(data){
                                  $('#cost-sum').text(data);
                              }
                        });

                        var url2='" . Url::to(['/site/get-cost']) . "';
                        var id = $('#sellform-id').val();
                        $.post(url2,{id:id},function(data){
                              if(data){
                                  $('#you_have').text(data);
                              }
                        });

                    })(this);"
                        )]) ?>

                <h4>За продажу вы получите: <span id="cost-sum">0</span> золота.</h4>
                <h5>(Комиссия 20%)</h5>
                <h4>У вас сейчас <span id="you_have">0</span> этого ресурса.</h4>


                <div class="form-group">
                    <?= Html::submitButton('Продать', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            <? endif; ?>

        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <? if ($action == "buy") : ?>

                <?php $form = ActiveForm::begin(); ?>

                <?

                $js = new \yii\web\JsExpression("
          var url='" . Url::to(['/site/get-col']) . "';
          $(document).on('change','#buyform-id',function(){
             var id = $(this).val();
                $.post(url,{id:id},function(data){
                      if(data){
                          $('#you_have').text(data);
                      }
                });

          })");
                $this->registerJs($js);
                ?>

                <?
                $resources = \app\models\Resource::find()->where('resource_id>1')->all();
                $items = ArrayHelper::map($resources, 'resource_id', 'resource_name');
                $params = [
                    'prompt' => 'Выберите ресурс'
                ];
                echo $form->field($model, 'id')->dropDownList($items, $params); ?>

                <?= $form->field($model, 'amount') ?>

                <h4>Ты сможешь купить <span id="you_have">0</span> этого ресурса.</h4>

                <div class="form-group">
                    <?= Html::submitButton('Купить', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            <? endif; ?>
        </div>
    </div>

</div>