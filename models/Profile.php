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
     * Обновление никнейма
     * @param $profile
     * @return bool
     */
    public function updateNickname($profile)
    {

        $profile_resource = ProfileResource::find()
            ->where(['user_id'=>Yii::$app->user->id])
            ->andWhere(['resource_id' => 1])
            ->with('resource')
            ->limit(1)
            ->one();

        if ($profile_resource->amount >= 200 && $profile->nickname != $this->nickname) {
            $profile->nickname = $this->nickname;
            $profile_resource->amount -= 200;

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
