<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var common\models\User $model
 */
$this->title = "No " . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?=
        Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Quiere eliminar a este usuario?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'username',
            'auth_key',
            'password_hash',
//            'password_reset_token',
            'email:email',
            'role',
//            ['attribute' => 'role','format'=>'text', 'label' => function($data) {
//                    if ($data->role == 1) {
//                        return "Administrador";
//                    }
//                    return "Gestor";
//                }],
//            'status',
            'created_at',
//            'updated_at',
        ],
    ])
    ?>

</div>
