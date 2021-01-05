<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Solicitud $model
 */

$this->title = 'Nueva Solicitud';
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'persona'=>$persona,
        'isUpdate'=>FALSE,
    ]) ?>

</div>
