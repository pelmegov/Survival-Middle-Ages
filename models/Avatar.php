<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "avatar".
 *
 * @property integer $id
 * @property string $link
 * @property string $name
 * @property integer $cost
 *
 * @property Profile[] $profiles
 */
class Avatar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'avatar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'name'], 'required'],
            [['cost'], 'integer'],
            [['link', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'name' => 'Name',
            'cost' => 'Cost',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['avatar_id' => 'id']);
    }
}
