<?php
/**
 * Created by PhpStorm.
 * User: modkomi
 * Date: 01.08.2016
 * Time: 19:44
 */

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;

class BehaviorsController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    /* Для всех */
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['index', 'contact', 'captcha']
                    ],
                    /* Для гостей */
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'verbs' => ['GET', 'POST'],
                        'actions' => ['reg', 'login'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['about', 'profile', 'test'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

}