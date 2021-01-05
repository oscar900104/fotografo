<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\Persona $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'telefonos')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'ci')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'cumpleannos')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
