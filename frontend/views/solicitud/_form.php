<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\Solicitud $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="solicitud-form">
    <br>
    <br>
    <?php $form = ActiveForm::begin(); ?>

    <?php
    if ($isUpdate) {
        if ($model->estado == 1) {
            echo $form->field($model, 'estado')->checkbox(['label' => 'Completada', 'checked']);
        } else {
            echo $form->field($model, 'estado')->checkbox(['label' => 'Completada']);
        }
    }
    ?>

    <?= $form->field($persona, 'nombre')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($persona, 'apellidos')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($persona, 'telefonos')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($persona, 'ci')->textInput() ?>

<?= $form->field($persona, 'direccion')->textInput(['maxlength' => 250]) ?>



    <?= $form->field($model, 'fecha_realizacion')->input("date") ?>

    <?= $form->field($model, 'hora_realizacion')->input("time") ?>

    <?= $form->field($model, 'precio')->input("number") ?>

    <?= $form->field($model, 'monto_inicial')->input("number") ?>

    <?= $form->field($model, 'servicios')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'lugar_realizacion')->textInput(['maxlength' => 250]) ?>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Insertar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
