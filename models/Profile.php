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
 */
class Profile extends \yii\db\ActiveRecord
{

    /**
     * Обновление никнейма
     * @param $profile
     * @return bool
     */
    public function updateNickname($profile)
    {

        $resource = UserResource::find()
            ->where(['user_id'=>Yii::$app->user->id])
            ->where(['resource_id' => 1])
            ->with('resource')
            ->one();

        if ($resource->amount >= 200 && $profile->nickname != $this->nickname) {
            $profile->nickname = $this->nickname;
            $resource->amount -= 200;
            $resource->save();
            return true;
        }
        return false;
    }

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
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nickname' => 'Nickname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
