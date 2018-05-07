<?php

namespace mikk150\formrenderer;

use yii\base\Widget;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Context;
use yii\widgets\ActiveForm;
use yii\base\Model;
use yii\helpers\Json;

class FormRendererWidget extends Widget
{
    /**
     * @var ActiveForm
     */
    public $form;
    
    /**
     * @var Model
     */
    public $model;

    /**
     * @inheritdoc
     */
    public function init()
    {

    }

    public function run()
    {
        $reflection = new \ReflectionClass($this->model);

        $string = '';

        foreach ($this->formBuilderArray($reflection) as $property => $formBuilderArray) {
            $field = $this->form->field($this->model, $property);
            $string .= call_user_func_array([$field, $formBuilderArray['method']], $formBuilderArray['options']);
        }

        return $string;
    }

    protected function formBuilderArray(\ReflectionClass $reflection)
    {
        $context = new Context($reflection->getNamespaceName());
        $doc = new DocBlock($reflection, $context);
        $properties = $reflection->getDefaultProperties();

        $properties = array_filter(array_keys($properties), function ($element) use ($doc, $reflection, $context) {
            $propertyReflection = $reflection->getProperty($element);
            $phpdoc = new DocBlock($propertyReflection, $context);

            return $phpdoc->hasTag('input');
        });
        $array = [];
        foreach ($properties as $property) {
            $array[$property] = $this->formBuilderPropertyArray($reflection->getProperty($property), $context);
        }
        return $array;
    }

    protected function formBuilderPropertyArray(\ReflectionProperty $propertyReflection, $context = null)
    {
        $phpdoc = new DocBlock($propertyReflection, $context);

        $stringer = $phpdoc->getTagsByName('input')[0];

        if (preg_match('/(?P<method>[a-zA-Z_]+)(?P<data>.*)/', $stringer->getContent(), $matches)) {
            return [
                'method' => $matches['method'],
                'options' => $matches['data'] ? Json::decode($matches['data']) : []
            ];
        }
        return [
            'method' => 'textInput',
            'options' => []
        ];
    }
}
