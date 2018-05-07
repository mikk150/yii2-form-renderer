<?php

namespace yiiacceptance\models;

use yii\base\Model;

class RequiredModel extends Model
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
                'required'
            ]
        ];
    }
}
