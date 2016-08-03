<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resource".
 *
 * @property integer $resource_id
 * @property string $resource_name
 * @property integer $needs_time
 * @property integer $amount
 *
 * @property ProfileResource[] $profileResources
 * @property Profile[] $users
 */
class Resource extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'resource';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['needs_time', 'amount'], 'integer'],
            [['resource_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'resource_id' => 'Resource ID',
            'resource_name' => 'Resource Name',
            'needs_time' => 'Needs Time',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfileResources()
    {
        return $this->hasMany(ProfileResource::className(), ['resource_id' => 'resource_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Profile::className(), ['user_id' => 'user_id'])->viaTable('profile_resource', ['resource_id' => 'resource_id']);
    }
}
