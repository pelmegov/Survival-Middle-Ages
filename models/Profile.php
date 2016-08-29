<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $nickname
 *
 * @property User $user
 * @property ProfileResource[] $profileResources
 * @property Resource[] $resources
 */
class Profile extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'profile';
    }

    public function rules()
    {
        return [
            [['nickname'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nickname' => 'Nickname',
        ];
    }

    /**
     * Покупка ресурсов
     * @param $id
     * @param $amount
     * @return array|bool
     */
    public function buy($id, $amount)
    {
        $profile = Profile::findOne(Yii::$app->user->id);

        $profile_resource = ProfileResource::find()
            ->where([
                "user_id" => $profile->user_id,
                "resource_id" => $id,
            ])
            ->andWhere("resource_id>1")
            ->one();

        $gold = ProfileResource::findOne([
            "user_id" => $profile->user_id,
            "resource_id" => 1
        ]);

        $isBuy = $gold->amount >= $amount * $profile_resource->resource->gold_ratio ? true : false;

        if ($isBuy) {
            $profile_resource->amount += $amount;
            $gold->amount -= $amount * $profile_resource->resource->gold_ratio;
            $gold->save();
            $profile_resource->save();
        }

        return $profile_resource ? [$profile_resource->amount, $gold->amount] : false;
    }

    /**
     * Продажа ресурсов
     * @param $id
     * @param $amount
     * @return array|bool
     */
    public function sell($id, $amount)
    {
        $profile = Profile::findOne(Yii::$app->user->id);

        $profile_resource = ProfileResource::find()
            ->where([
                "user_id" => $profile->user_id,
                "resource_id" => $id,
            ])
            ->andWhere("resource_id>1")
            ->one();

        $gold = ProfileResource::findOne([
            "user_id" => $profile->user_id,
            "resource_id" => 1
        ]);

        $isBuy = $profile_resource->amount - $amount >= 0 ? true : false;

        if ($isBuy) {
            $profile_resource->amount -= $amount;
            $gold->amount += floor((($amount * $profile_resource->resource->gold_ratio) * 0.80));
            $gold->save();
            $profile_resource->save();
        }

        return $profile_resource ? [$profile_resource->amount, $gold->amount] : false;
    }

    /**
     * Обновление времени, оставшегося до конца работы
     * @param $profile_resource
     * @return bool
     */
    public function updateNeedsTime($profile_resource)
    {

        if (!$profile_resource) return false;

        $profile_resource->needs_time =
            number_format($profile_resource->resource->needs_time - (time() - $profile_resource->needs_time) / 60, 2);
        if ($profile_resource->needs_time <= 0) {
            $profile_resource->needs_time = 0;
            $profile_resource->amount += $profile_resource->resource->amount;
            \Yii::$app->getSession()->setFlash('endWork',
                '<div class="bg-success" style="padding: 10px;"><h2>Вы закончили работать и получили '
                . $profile_resource->resource->amount . ' '
                . $profile_resource->resource->resource_name
                . '!</h2></div>'
            );
        }
        $profile_resource->save();
    }

    /**
     * Найти ресурс по ID, который добывается
     * @param $id
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    public function findResource($id)
    {
        $resource = Resource::find()
            ->where(['resource_id' => $id])
            ->andWhere('needs_time>0')
            ->one();
        return $resource ? $resource : false;
    }

    /**
     * Проверка работает ли сейчас Юзер
     * Если юзер не работает, вернет false,
     * иначе вернет profile_resource
     * @return array|bool|null|\yii\db\ActiveRecord
     */
    public function isWork()
    {
        $profile_resource = ProfileResource::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere('needs_time>0')
            ->limit(1)
            ->one();
        return $profile_resource ? $profile_resource : false;
    }

    /**
     * Обновление никнейма
     * @param $profile
     * @return bool
     */
    public function updateNickname($profile)
    {
        $profile_resource = ProfileResource::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['resource_id' => 1])
            ->with('resource')
            ->limit(1)
            ->one();

        if ($profile_resource->amount >= 200 && $profile->nickname != $this->nickname) {
            $profile->nickname = $this->nickname;
            $profile_resource->amount -= 200;

            \Yii::$app->getSession()->setFlash('successProfileUpdate',
                '<div class="bg-success" style="padding: 10px;"><h2>Данные успешно обновлены!</h2></div>'
            );

            $profile_resource->save();
            return true;
        }
        return false;
    }

    /**
     * Обновление профиля
     * @return bool
     */
    public function updateProfile()
    {
        $profile = ($profile = Profile::findOne(Yii::$app->user->id)) ? $profile : new Profile();
        $profile->user_id = Yii::$app->user->id;

        $this->updateNickname($profile);

        if ($profile->save()):
            $user = $this->user ? $this->user : User::findOne(Yii::$app->user->id);

            /* Изменение эмейла */
            $email = Yii::$app->request->post('User')['email'];
            $user->email = isset($email) ? $email : $user->email;

            return $user->save() ? true : false;
        endif;
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileResources()
    {
        return $this->hasMany(ProfileResource::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resource::className(), ['resource_id' => 'resource_id'])->viaTable('profile_resource', ['user_id' => 'user_id']);
    }

}
