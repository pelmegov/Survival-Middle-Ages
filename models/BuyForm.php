<?php

namespace app\models;

use yii\base\Model;

class BuyForm extends Model
{
    public $id;
    public $amount;

    public function rules()
    {
        return [
            [['id', 'amount'], 'integer'],
            [['id', 'amount'], 'required']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Выберите товар для покупки',
            'amount' => 'Количество',
        ];
    }

}
