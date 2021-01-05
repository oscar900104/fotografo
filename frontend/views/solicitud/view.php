<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var frontend\models\Solicitud $model
 */
$this->title = " No " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Solicitudes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//print_r($persona);
?>
<div class="solicitud-view">
    <div class="row">
        <div class="col-sm-2">
            <h1><?= Html::encode($this->title) ?> </h1>
        </div>
        <div class="col-sm-1">
            <h3><?php
                if ($model->estado == 1) {
                    echo '<span class="label label-success">Completada</span>';
                }
                if ($model->estado == 2) {
                    echo '<span class="label label-default">Vencida</span>';
                }
                if ($model->estado == 0) {
                    echo '<span class="label label-warning">Pendiente</span>';
                }
                ?></h3>
        </div>
    </div>
    <br>
    <br>
    <br>
    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Quiere eliminar este elemento?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <!--<h3>Datos del cliente</h3>-->

    <?=
    DetailView::widget([
        'model' => $persona,
        'attributes' => [
//             'id',
            'nombre',
            'apellidos',
            'telefonos',
            'ci',
            'direccion',
        ],
    ])
    ?>
    <br>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'id_persona',

            'precio',
            'monto_inicial',
            'fecha_solicitud',
            'fecha_realizacion',
            'hora_realizacion',
            'servicios:ntext',
            'lugar_realizacion',
        ],
    ])
    ?>


</div>
