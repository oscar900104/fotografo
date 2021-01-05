<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Studio N',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                    ['label' => 'Dashboard', 'url' => ['/site/index']]
//                ['label' => 'About', 'url' => ['/site/about']],
//                ['label' => 'Persona', 'url' => ['/persona/']],
//                ['label' => 'Solicitud', 'url' => ['/solicitud/']],
//                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
//                $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = ['label' => 'Gestion solicitud', 'items' => [
                            ['label' => 'Listado de solicitudes', 'url' => ['/solicitud/']],
                            ['label' => 'Insertar solicitud', 'url' => ['/solicitud/create']],
                    ],];
                if (Yii::$app->user->identity->role == 1) {
                    $menuItems[] = ['label' => 'Seguridad', 'items' => [
//                            ['label' => 'Nuevo usuario', 'url' => ['/user/create']],
                                ['label' => 'Nuevo usuario', 'url' => ['/site/signup']],
                                ['label' => 'Lista de usuarios', 'url' => ['/user/']],
                                ['label' => 'Salvar BD (proximamente)', 'url' => '#', 'options' => ['class' => 'disabled']],
                                ['label' => 'Trazas (proximamente)', 'url' => '#', 'options' => ['class' => 'disabled']],
                        ],];
                }
                $menuItems[] = [
                    'label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Studio N <?= date('Y') ?></p>
                <p class="pull-right">Desarrollado por <strong>Dargoz</strong></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
