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
            'username' => 'Имя пользователя',
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

        /* Сохранение нового User и возврат ошибки, если это не удалось сделать */
        if (!$user->save()) return false;

        /* Создание профиля для только что созданного User */
        $profile = new Profile();

        /* Базовые настройки профиля */
        $profile->first_name = "DEFAULT_USER_" . $user->id;
        $profile->fish = 5;
        $profile->stone = 10;
        $profile->animal = 20;
        $profile->wood = 10;

        /* Сохранение Profile и возврат User */
        return $profile->save() ? $user : false;
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