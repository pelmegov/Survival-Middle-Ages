<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_tracker".
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $title
 * @property string $text
 * @property integer $status
 * @property integer $created_at
 *
 * @property Profile $profile
 */
class TaskTracker extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_tracker';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'status', 'created_at'], 'integer'],
            [['title', 'created_at'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['profile_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'profile_id' => 'Profile ID',
            'title' => 'Title',
            'text' => 'Text',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'profile_id']);
    }
}
