<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:17
 */
namespace app\models;

use yii\base\Model;
use Yii;

class RegForm extends Model
{
    const ROLE_USER = 10;
    const ROLE_ADMIN = 20;

    public $username;
    public $email;
    public $password;
    public $status;
    public $role;

    public function rules()
    {
        return [
            ['role', 'default', 'value' => 10],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_ADMIN]],
            [['username', 'email', 'password'], 'filter', 'filter' => 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'В поле логина допустимы лишь английские символы и цифры'],
            ['password', 'string', 'min' => 6, 'max' => 255],
            ['username', 'unique',
                'targetClass' => User::className(),
                'message' => 'Это имя уже занято.'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' => [
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => User::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин (используется для входа на сайт)',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'role' => 'Роль'
        ];
    }

    /**
     * Регистрация
     * @return User|bool
     */
    public function reg()
    {
        /* Базовые настройки профиля User */
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($this->scenario === 'emailActivation')
            $user->generateSecretKey();

        /* Сохранение User и возврат ошибки, если это не удалось сделать */
        if (!$user->save()) return false;

        /* Создание профиля для только что созданного User */
        $profile = new Profile();
        /* Задание дефолтного значения имени */
        $profile->nickname = "DEFAULT_USER_" . $user->id;
        $profile->save();

        $resource = new ProfileResource();
        $resource->user_id = $user->id;
        $resource->resource_id = 1;
        $resource->needs_time = 0;
        $resource->amount = 200;
        $resource->save();

        $resource = new ProfileResource();
        $resource->user_id = $user->id;
        $resource->resource_id = 2;
        $resource->needs_time = 0;
        $resource->amount = 2;
        $resource->save();

        $resource = new ProfileResource();
        $resource->user_id = $user->id;
        $resource->resource_id = 3;
        $resource->needs_time = 0;
        $resource->amount = 2;
        $resource->save();

        $resource = new ProfileResource();
        $resource->user_id = $user->id;
        $resource->resource_id = 4;
        $resource->needs_time = 0;
        $resource->amount = 2;
        $resource->save();

        $resource = new ProfileResource();
        $resource->user_id = $user->id;
        $resource->resource_id = 5;
        $resource->needs_time = 0;
        $resource->amount = 2;
        $resource->save();

        return $user;
    }

    /**
     * Отправка купона для активации аккаунта
     * @param $user
     * @return bool
     */
    public function sendActivationEmail($user)
    {
        return Yii::$app->mailer->compose('activationEmail', ['user' => $user])
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' (отправлено роботом).'])
            ->setTo($this->email)
            ->setSubject('Активация для ' . Yii::$app->name)
            ->send();
    }
}