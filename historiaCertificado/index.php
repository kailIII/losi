<?php
include_once '../inicio/valido.php';
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$oMysqlDependencia = $oMysql->getDependenciaActiveRecord();
$oDependencia = new DependenciaValueObject();
$oDependencia = $oMysqlDependencia->buscarTodo();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Expediente - Certificados</title>
        <?php include_once "../includes/php/estilos.php"; ?>
        <script type="text/javascript" src="js/funciones.js"></script>
    </head>
    <body>
        <?php include_once "../includes/php/header.php"; ?>
        <div class="container">
            <legend>Expediente Certificados</legend>
            <div class="row table-responsive">
                <?php
                /* Buscar a travez del id del expediente los datos para poder buscar el historial del mismo. */
                $oExpedientes = new ExpedientesValueObject();
                $oMysqlExpedientes = $oMysql->getExpedientesActiveRecord();
                $oExpedientes->setIdexpediente($_GET['id']);
                $oExpedientes = $oMysqlExpedientes->buscarPorExpediente($oExpedientes);

                /* Falta mostrar el nombre de la obra */
                $oMysqlObra = $oMysql->getObrasEjecutadasActiveRecord();
                $oObra = new ObrasEjecutadasValueObject();

                $oObra->setID($oExpedientes[0]->getIdObra());
                $oObra = $oMysqlObra->buscar($oObra);
                ?>
                <input type="hidden" id="idexpe" name="idexpe" value="<?php echo $_GET['id']; ?>" />
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td colspan="10" class="success"><?php echo utf8_encode($oObra->getDenominacion() . " -- " . $oObra->getExpPrincipal()); ?></td>
                        </tr>
                        <tr>
                            <th>Certificado</th>
                            <th>Certificado DNV</th>
                            <th>Expediente DNV</th>
                            <th>Expediente DPV</th>
                            <th>Mes</th>
                            <th>Importe</th>
                            <th>Vto.</th>
                        </tr>
                        <tr>
                            <td><?php echo $oExpedientes[0]->getCertNro(); ?></td>
                            <td><?php echo $oExpedientes[0]->getCertDnv(); ?></td>
                            <td><?php echo $oExpedientes[0]->getExpDnv(); ?></td>
                            <td><?php echo $oExpedientes[0]->getExpDpv(); ?></td>
                            <td><?php echo $oExpedientes[0]->getMes(); ?></td>
                            <td><?php echo $oExpedientes[0]->getImporte(); ?></td>
                            <td><?php echo $oExpedientes[0]->getVencimiento(); ?></td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <strong> Cedido:
                                    <?php echo $oExpedientes[0]->getCedido(); ?>
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="col-md-9">
                                    <input class="form-control" data-toggle="tooltip" name="cedido" id="cedido" title="" alt="" type="text" value="" />
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <span  class="glyphicon glyphicon-ok" onclick="almacenarCedido(<?php echo $_GET['id']; ?>);" title="Almacenar cedido" alt="Almacenar cedido"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <span  class="glyphicon glyphicon-list" onclick="almacenarComentario(<?php echo $_GET['id']; ?>);" title="Almacenar comentario" alt="Almacenar comentario"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-danger btn-sm">
                                            <span class="glyphicon glyphicon-circle-arrow-down" onclick="finalizarExpediente(<?php echo $_GET['id']; ?>);" title="Finalizar expediente" alt="Finalizar expediente"></span>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row" id="Nueva" style="display: none;">
                <div class="row">
                    <div class="col-sm-4 col-lg-4">
                        <label class="label-success label">Fecha</label>
                        <input class="form-control" data-toggle="tooltip" name="fechaNueva" id="fechaNueva" title="Fecha" alt="Fecha" type="date" value="<?php echo date('Y-m-d'); ?>" />
                    </div>
                    <div class="col-sm-2 col-lg-2">
                    </div>
                    <div class="col-sm-6 col-lg-6">
                        <label class="label-success label">Dependencia</label>
                        <select id="depenNueva" name="depenNueva" class="select-block" >
                            <option value="0">Seleccione una dependencia</option>
                            <?php
                            foreach ($oDependencia as $aDependencia) {
                                if ($aDependencia->getDependencia() != '') {
                                    ?><option value="<?php echo $aDependencia->getIddependencia(); ?>"><?php echo $aDependencia->getDependencia(); ?></option><?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label class="label-success label">Comentario</label>
                        <input class="form-control" name="comenNueva" id="comenNueva" title="Comentario" alt="Comentario" placeholder="Comentario">
                    </div>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-sm-3">
                    <!--<input type="button" value="Guardar" class="btn btn-large btn-block btn-primary" onclick="guardarDatos()" id="accion" />-->
                    <button class="btn btn-large btn-block btn-primary" onclick="guardarDatos()" id="accion">
                        <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Cargando
                    </button>
                </div>
                <div class="col-sm-9">
                    <div id="divResultado" style="animation: fadein 1s;"></div>
                </div>
            </div>
            <br>

            <div class="row table-responsive">
                <?php
                /* Ahora tengo que mostrar el historial del expediente. */
                $oExpHistoria = new ExpHistoriaValueObject();
                $oMysqlExpHistoria = $oMysql->getExpHistotiaActiveRecord();
                $oExpHistoria->setIdexpediente($oExpedientes[0]->getIdexpediente());
                $oExpHistoria = $oMysqlExpHistoria->buscar($oExpHistoria);
                ?>
                <legend>Historico</legend>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>Fecha</th>
                        <th>Dependencia</th>
                        <th>Comentario</th>
                    </tr>
                    <tr>
                        <td><div id="fecha"></div></td>
                        <td><div id="depen"></div></td>
                        <td><div id="comen"></div></td>
                    </tr>
                    <?php
                    $dependencia = "";
                    $oMysqlDependencia = $oMysql->getDependenciaActiveRecord();
                    $oDependencia = new DependenciaValueObject();
                    foreach ($oExpHistoria as $historia) {
                        /* Busco el identificador de la dependencia. */
                        $oDependencia->setIddependencia($historia->getDependencia());
                        if (!$oMysqlDependencia->buscar($oDependencia)) {
                            $oDependencia->setDependencia('Desconocido');
                        }
                        ?>
                        <tr>
                            <?php
                            if ($oDependencia->getDependencia() == 'comentario') {
                                ?>
                                <td><?php echo $historia->getFecha(); ?></td>                                
                                <td colspan="2"><?php echo $historia->getComentario(); ?></td>
                                <?php
                            } else {
                                ?>
                                <td><?php echo $historia->getFecha(); ?></td>
                                <td><?php echo $oDependencia->getDependencia(); ?></td>
                                <td><?php echo $historia->getComentario(); ?></td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                        if ($dependencia === '' && $oDependencia->getDependencia() != 'comentario') {
                            $dependencia = $oDependencia->getDependencia();
                        }
                    }
                    ?>
                </table>
                <input type="hidden" value="<?php echo $dependencia; ?>" id="dependencia" />
            </div>

            <div id="divResultado1"></div>
            <script> busquedaExpediente(<?php echo "'" . $oExpedientes[0]->getExpDnv() . "'"; ?>);</script>
        </div>
    </div>
    <?php include_once "../includes/php/footer.php"; ?>
    <?php include_once "../includes/php/flatui_js.php"; ?>
</body>
</html>