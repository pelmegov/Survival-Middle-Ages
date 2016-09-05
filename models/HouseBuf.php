<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house_buf".
 *
 * @property integer $house_id
 * @property integer $buf_id
 *
 * @property Buf $buf
 * @property House $house
 */
class HouseBuf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house_buf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['house_id', 'buf_id'], 'required'],
            [['house_id', 'buf_id'], 'integer'],
            [['buf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buf::className(), 'targetAttribute' => ['buf_id' => 'buf_id']],
            [['house_id'], 'exist', 'skipOnError' => true, 'targetClass' => House::className(), 'targetAttribute' => ['house_id' => 'house_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'house_id' => 'House ID',
            'buf_id' => 'Buf ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuf()
    {
        return $this->hasOne(Buf::className(), ['buf_id' => 'buf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['house_id' => 'house_id']);
    }
}
