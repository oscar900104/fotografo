<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\SolicitudSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="solicitud-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

  
    
   

    <?php echo $form->field($model, 'to_search') ?>
    
    <?php // echo $form->field($model, 'servicios') ?>

    <?php // echo $form->field($model, 'lugar_realizacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Borrar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
