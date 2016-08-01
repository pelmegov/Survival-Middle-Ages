<?php

namespace app\models;

use Yii;
use yii\web\Session;

/**
 * This is the model class for table "profile".
 *
 * @property integer $user_id
 * @property string $first_name
 * @property integer $fish
 * @property integer $animal
 * @property integer $wood
 * @property integer $stone
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{

    public function createProfile()
    {
    }

    /**
     * Обновление никнейма
     * @param $profile
     * @return bool
     */
    public function updateNickname($profile)
    {
        if ($profile->gold >= 200) {
            $profile->first_name = $this->first_name;
            $profile->gold -= 200;
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
            [['fish', 'animal', 'wood', 'stone', 'gold'], 'integer'],
            [['first_name'], 'string', 'max' => 32],
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
            'first_name' => 'Nickname',
            'fish' => 'Fish',
            'animal' => 'Animal',
            'wood' => 'Wood',
            'stone' => 'Stone',
            'gold' => 'Gold'
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
