<?php

namespace formbuilder\tests\unit;

use yii\base\Model;

class TestModel extends Model
{
    /**
     * @input textInput
     */
    public $testField;

    /**
     * @input
     */
    public $noDefinitionField;

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
