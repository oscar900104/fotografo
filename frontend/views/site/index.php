<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Studio N';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Dashboard</h1>

        <!--<p class="lead">You have successfully created your Yii-powered application.</p>-->

        <!--<p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>-->
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-red set-icon">
                        <i class="fa fa-rocket"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text"><?php echo $proximas ?></p>
                        <p class="text-muted">Que realizar en 2 dias</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-brown set-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text"><?php echo $pendientes ?> </p>
                        <p class="text-muted">Pendientes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-blue set-icon">
                        <i class="fa fa-bell-o"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text"><?php echo $enLaSemana ?></p>
                        <p class="text-muted">Nuevas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">           
                <div class="panel panel-back noti-box">
                    <span class="icon-box bg-color-green set-icon">
                        <i class="fa fa-check"></i>
                    </span>
                    <div class="text-box" >
                        <p class="main-text"><?php echo $completas ?></p>
                        <p class="text-muted">Completadas</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- /. ROW  -->
        <!--        <div class="row">
                    <div class="col-lg-4">
                        <h2>Alertas</h2>
                        <div class="panel ">
                            <div class="main-temp-back">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6"> <i class="fa fa-bell-o fa-3x"></i> <br>  Con 2 d&iacute;as para su ejecuci&oacute;n </div>
                                        <div class="col-xs-6">
                                            <div class="text-temp"> <?php echo $proximas ?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
        
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-edit fa-3x"></i>
                                <h3> <?php echo $enLaSemana ?></h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Solicitudes en los &uacute;ltimos 10 d&iacute;as
                            </div>
                        </div> 
                    </div> 
        
                </div>-->
        <div class="row">
            <div class="col-lg-6">
                <h2>Estado de las solicitudes</h2>
                <div class="content-panel">
                    <div class="panel-body text-center">
                        <canvas id="pie" height="300" width="400"></canvas>
                    </div>
                </div>

                <span style="background-color: #C7604C; color: #333333"><strong>Completadas</strong></span>
                <span style="background-color: #16a085;color: #333333"><strong>Pendientes</strong></span>
                <span style="background-color: #584A5E;color: #333333"><strong>Vencidas</strong></span>
            </div>
            <div class="col-lg-6">
                <h2>Variacion en los precios</h2>
                <div class="content-panel">
                    <div class="panel-body text-center">
                        <canvas id="line" height="330" width="400"></canvas>
                    </div>

                </div>  
            </div>


        </div>

    </div>
</div>
<script>
    var L_precios = '<?php echo $L_precios ?>';
    var L = L_precios.split(",");
    L.splice(L.length - 1);
    console.info(L);
    //console.info(L2);
    console.info(L.length);
    var cant = L.length - 1;
    var completas = '<?php echo $completas ?>';
    var pendientes = '<?php echo $pendientes ?>';
    var vencidas = '<?php echo $vencidas ?>';
    completas = completas * 100 / cant;
    pendientes = pendientes * 100 / cant;
    vencidas = vencidas * 100 / cant;
    window.onload = function () {





    }//Fin onload


</script>