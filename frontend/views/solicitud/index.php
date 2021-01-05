<?php

use frontend\models\SolicitudSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var SolicitudSearch $searchModel
 */
$this->title = 'Solicitudes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-index ">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <br>
    <p>
        <?= Html::a('Nueva Solicitud', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
//         'summary' => FALSE,
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//            'id',
                ['label' => 'Estado', 'value' => function($data) {
                    if ($data->estado == 1) {
                        return '<span class="label label-success">Completada</span>';
                    }
                    if ($data->estado == 2) {
                        return '<span class="label label-default">Vencida</span>';
                    }
                    return '<span class="label label-warning">Pendiente</span>';
                }, 'format' => 'html', 'options' => ['style' => 'height: 90px;']],
                ['label' => 'Cliente', 'value' => function($data) {
                    $current = \frontend\models\Persona::findOne(['id' => $data->id_persona]);
                    return $current->nombre . " " . $current->apellidos;
                }],
                ['label' => 'Precio(cuc)', 'value' => 'precio'],
//            'fecha_solicitud',
            ['label' => 'Fecha', 'value' => 'fecha_realizacion'],
                ['label' => 'Hora', 'value' => 'hora_realizacion'],
                ['label' => 'Lugar', 'value' => 'lugar_realizacion'],
                ['label' => 'Servicios', 'value' => 'servicios'],
//            'fecha_realizacion',
//            'hora_realizacion',
//            'servicios:ntext',
//            'lugar_realizacion',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
