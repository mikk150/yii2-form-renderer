<?php

use yii\widgets\ActiveForm;
use mikk150\formrenderer\FormRendererWidget;

?>

<?php $form = ActiveForm::begin(); ?>

<?= FormRendererWidget::widget([
    'form' => $form,
    'model' => $model
]) ?>

<?php ActiveForm::end();