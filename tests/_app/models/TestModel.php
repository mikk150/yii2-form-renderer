<?php

namespace yiiacceptance\models;

use yii\base\Model;

class TestModel extends Model
{
    /**
     * @input textInput
     */
    public $testField;

    public function rules()
    {
        return [
            [
                'testField',
                'safe'
            ]
        ];
    }
}
