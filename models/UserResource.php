<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_resource".
 *
 * @property integer $user_id
 * @property integer $resource_id
 * @property integer $amount
 * @property integer $time_start
 *
 * @property Resource $resource
 * @property User $user
 */
class UserResource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'resource_id'], 'required'],
            [['user_id', 'resource_id', 'amount', 'time_start'], 'integer'],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resource::className(), 'targetAttribute' => ['resource_id' => 'resource_id']],
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
            'resource_id' => 'Resource ID',
            'amount' => 'Amount',
            'time_start' => 'Time Start',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resource::className(), ['resource_id' => 'resource_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
