<?php

namespace formbuilder\tests\unit;

use Codeception\Test\Unit;
use yii\widgets\ActiveForm;
use yii\base\DynamicModel;
use mikk150\formrenderer\FormRendererWidget;
use yii\base\InvalidConfigException;
use yii\web\View;

class FormRendererWidgetTest extends Unit
{
    public function testFormNotGiven()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Attribute "form" is not defined or has to be instance of "yii\widgets\ActiveForm".');

        $model = new DynamicModel([
            'testAttribute' => ''
        ]);

        $widget = FormRendererWidget::widget([
            'model' => $model
        ]);
    }

    public function testModelNotGiven()
    {
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Attribute "model" is not defined or has to be instance of "yii\base\Model".');

        $form = $this->make(ActiveForm::class, [
            'init' => function () {}
        ]);

        $widget = FormRendererWidget::widget([
            'form' => $form
        ]);

        ActiveForm::end();
    }

    public function testRenderedOutput()
    {
        $view = new View;

        $form = $this->make(ActiveForm::class, [
            'init' => function () {
            },
            'view' => $view
        ]);
        $model = new TestModel;

        $widget = FormRendererWidget::widget([
            'form' => $form,
            'model' => $model,
        ]);

        $this->assertEquals('<div class="form-group field-testmodel-testfield">
<label class="control-label" for="testmodel-testfield">Test Field</label>
<input type="text" id="testmodel-testfield" class="form-control" name="TestModel[testField]">

<div class="help-block"></div>
</div><div class="form-group field-testmodel-nodefinitionfield">
<label class="control-label" for="testmodel-nodefinitionfield">No Definition Field</label>
<input type="text" id="testmodel-nodefinitionfield" class="form-control" name="TestModel[noDefinitionField]">

<div class="help-block"></div>
</div>', $widget);
    }
}
