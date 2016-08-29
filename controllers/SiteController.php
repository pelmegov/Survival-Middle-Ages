<?php

namespace app\controllers;

use app\models\BuyForm;
use app\models\Profile;
use app\models\Resource;
use app\models\ProfileResource;
use app\models\SellForm;
use Yii;
use app\models\RegForm;
use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends BehaviorsController
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $profile = ($profile = Profile::findOne(Yii::$app->user->id)) ? $profile : new Profile();

//        $model = ProfileResource::find()
//            ->where(['user_id' => Yii::$app->user->id])
//            ->with(['resource', 'user'])
//            ->all();

        if ($profile && $model = $profile->isWork()) {
            $profile->updateNeedsTime($model);
        } else {
            $model = false;
        }

        return $this->render(
            'index',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Регистрация
     * @return string|\yii\web\Response
     */
    public function actionReg()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $emailActivation = Yii::$app->params['emailActivation'];
        $model = $emailActivation ? new RegForm(['scenario' => 'emailActivation']) : new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                else:
                    if ($model->sendActivationEmail($user)):
                        Yii::$app->session->setFlash('success', 'Письмо с активацией отправлено на емайл <strong>' . Html::encode($user->email) . '</strong> (проверьте папку спам).');
                    else:
                        Yii::$app->session->setFlash('error', 'Ошибка. Письмо не отправлено.');
                        Yii::error('Ошибка отправки письма.');
                    endif;
                    return $this->refresh();
                endif;
            else:
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                Yii::error('Ошибка при регистрации');
                return $this->refresh();
            endif;
        endif;
        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Авторизация
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Выход
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Контакты
     * TODO: Надо ли?
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Профиль
     *
     * @return string
     */
    public function actionProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $profile = ($profile = Profile::findOne(Yii::$app->user->id)) ? $profile : new Profile();

        if ($model = $profile->isWork()) {
            $profile->updateNeedsTime($model);
        }

        $model = ProfileResource::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->with(['resource', 'user'])
            ->all();

        return $this->render(
            'profile',
            [
                'model' => $model,
                'profile' => $profile
            ]
        );
    }

    public function actionEditProfile()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = ($model = Profile::findOne(Yii::$app->user->id)) ? $model : new Profile();
        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($model->updateProfile()):
                Yii::$app->session->setFlash('success', 'Профиль изменен');
                return $this->actionProfile();
            else:
                Yii::$app->session->setFlash('error', 'Профиль не изменен');
                Yii::error('Ошибка записи. Профиль не изменен');
                return $this->refresh();
            endif;
        endif;

        return $this->render(
            'edit-profile',
            [
                'model' => $model
            ]
        );
    }

    public function actionMarketResources()
    {

        $request = Yii::$app->request;
        $action = $request->get('action');

        $profile = Profile::findOne(Yii::$app->user->id);

        if ($action == "buy") {
            $model = new BuyForm();
        } else if ($action == "sell") {
            $model = new SellForm();
        } else {
            return $this->actionProfile();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($action == "buy") {
                $profile->buy($model->id, $model->amount);
            }
            if ($action == "sell") {
                $profile->sell($model->id, $model->amount);
            }
            return $this->render('market-resources', [
                'model' => $model,
                'action' => $action
            ]);
        } else {
            return $this->render('market-resources', [
                'model' => $model,
                'action' => $action
            ]);
        }

    }

    public function actionGetCol()
    {
        $prod_id = Yii::$app->request->post('id');

        $profile_resource = ProfileResource::findOne([
            "user_id" => Yii::$app->user->id,
            "resource_id" => $prod_id
        ]);

        $gold_ratio = $profile_resource->resource->gold_ratio;

        $gold = ProfileResource::findOne([
            "user_id" => Yii::$app->user->id,
            "resource_id" => 1
        ]);

        $isBuy = $gold->amount >= $gold_ratio;

        if ($isBuy) {
            return floor($gold->amount / $gold_ratio);
        }
        return 0;
    }

    public function actionGetCost()
    {
        $id = Yii::$app->request->post('id');

        $model = ProfileResource::findOne([
            "user_id" => Yii::$app->user->id,
            "resource_id" => $id
        ]);

        return $model->amount;
    }

    public function actionGetSum()
    {
        $prod_id = Yii::$app->request->post('prod_id');
        $col = Yii::$app->request->post('col');

        if ($col < 0) return 0;

        $profile_resource = ProfileResource::findOne([
            "user_id" => Yii::$app->user->id,
            "resource_id" => $prod_id
        ]);

        $gold_ratio = $profile_resource->resource->gold_ratio;

        $isBuy = $profile_resource->amount - $col >= 0 ? true : false;

        if ($isBuy) {
            $result = floor((($col * $gold_ratio) * 0.80));
        }

        return $result;
    }

    public function actionWork()
    {
        $request = Yii::$app->request;
        $id = (int)$request->get('id');
        $want_work = (int)$request->get('yes');
        $profile = Profile::findOne(Yii::$app->user->id);
        $model = $profile->isWork();

        if ($model) {
            $profile->updateNeedsTime($model);
        } else {
            $resource = $profile->findResource($id);
            if (!$resource) return $this->goHome();

            $model = ProfileResource::findOne([
                'user_id' => Yii::$app->user->id,
                'resource_id' => $resource->resource_id
            ]);

            if ($want_work == 1) {
                $model->needs_time = time();
                $model->save();
                return $this->goHome();
            }
        }
        return $this->render(
            'work',
            [
                'model' => $model
            ]
        );
    }

}
