<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buf".
 *
 * @property integer $buf_id
 * @property string $buf_name
 * @property string $buf_effect
 *
 * @property HouseBuf[] $houseBufs
 * @property House[] $houses
 */
class Buf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buf_name', 'buf_effect'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buf_id' => 'Buf ID',
            'buf_name' => 'Buf Name',
            'buf_effect' => 'Buf Effect',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouseBufs()
    {
        return $this->hasMany(HouseBuf::className(), ['buf_id' => 'buf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['house_id' => 'house_id'])->viaTable('house_buf', ['buf_id' => 'buf_id']);
    }
}
