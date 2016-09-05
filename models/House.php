<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property integer $house_id
 * @property integer $group_id
 * @property string $house_name
 *
 * @property HouseGroup $group
 * @property HouseBuf[] $houseBufs
 * @property Buf[] $bufs
 * @property Profile[] $profiles
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'group_id'], 'required'],
            [['house_id', 'group_id'], 'integer'],
            [['house_name'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => HouseGroup::className(), 'targetAttribute' => ['group_id' => 'group_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'house_id' => 'House ID',
            'group_id' => 'Group ID',
            'house_name' => 'House Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(HouseGroup::className(), ['group_id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouseBufs()
    {
        return $this->hasMany(HouseBuf::className(), ['house_id' => 'house_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBufs()
    {
        return $this->hasMany(Buf::className(), ['buf_id' => 'buf_id'])->viaTable('house_buf', ['house_id' => 'house_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['house_id' => 'house_id']);
    }
}
