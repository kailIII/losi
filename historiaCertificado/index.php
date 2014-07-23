<?php
include_once '../inicio/valido.php';
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();
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
            <div class="form-group col-lg-12">
                <ul class="pager">
                    <li class="previous">
                        <a href="javascript:history.back();">
                            <span class="fui-arrow-left"></span>
                            <span>Listado Expediente</span>
                        </a>
                    </li>
                </ul>
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
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td colspan="10" class="success"><?php echo utf8_encode($oObra->getDenominacion() . " -- " . $oObra->getExpPrincipal()); ?></td>
                    </tr>
                    <tr>
                        <th>Certificado DPV</th>
                        <th>Certificado DNV</th>
                        <th>Expediente DNV</th>
                        <th>Expediente DPV</th>
                        <th>Mes</th>
                        <th>Importe</th>
                        <th>Vto.</th>
                        <th>Cedido</th>
                    </tr>
                    <tr>
                        <td><?php echo $oExpedientes[0]->getCertNro(); ?></td>
                        <td><?php echo $oExpedientes[0]->getCertDnv(); ?></td>
                        <td><?php echo $oExpedientes[0]->getExpDnv(); ?></td>
                        <td><?php echo $oExpedientes[0]->getExpDpv(); ?></td>
                        <td><?php echo $oExpedientes[0]->getMes(); ?></td>
                        <td><?php echo $oExpedientes[0]->getImporte(); ?></td>
                        <td><?php echo $oExpedientes[0]->getVencimiento(); ?></td>
                        <td>
                            <input type="text" id="cedido" name="cedido" 
                                   value="<?php echo $oExpedientes[0]->getCedido(); ?>" ondblclick="habilita(this.id)"/>
                        </td>
                    </tr>
                </table>
                <?php
                /* Ahora tengo que mostrar el historial del expediente. */
                $oExpHistoria = new ExpHistoriaValueObject();
                $oMysqlExpHistoria = $oMysql->getExpHistotiaActiveRecord();
                $oExpHistoria->setIdexpediente($oExpedientes[0]->getIdexpediente());
                $oExpHistoria = $oMysqlExpHistoria->buscar($oExpHistoria);
                ?>
                <legend>Hitorico</legend>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th>Fecha</th>
                        <th>Dependencia</th>
                        <th>Comentario</th>
                    </tr>
                    <tr id="actual" style="display: none;">
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
                        if(!$oMysqlDependencia->buscar($oDependencia)){
                            $oDependencia->setDependencia('Desconocido');
                        }
                    ?>
                    <tr>
                        <td><?php echo $historia->getFecha(); ?></td>
                        <td><?php echo $oDependencia->getDependencia(); ?></td>
                        <td><?php echo $historia->getComentario(); ?></td>
                    </tr>
                    <?php
                    if($dependencia === '')
                        $dependencia = $oDependencia->getDependencia();
                    }
                    ?>
                </table>
                <input type="hidden" value="<?php echo $dependencia; ?>" id="dependencia" />
                <div class="span3">
                    <input type="button" value="&nbsp;&nbsp;&nbsp;Guardar&nbsp;&nbsp;&nbsp;" class="btn btn-large btn-block btn-primary" onclick="guardarDatos()" />
                </div>
            </div>
            <div id="divResultado"></div>
            <div id="divResultado1"></div>
            <script> busquedaExpediente(<?php echo "'".$oExpedientes[0]->getExpDnv()."'"; ?>); </script>
        </div>
        <?php include_once "../includes/php/footer.php";?>
        <?php include_once "../includes/php/flatui_js.php";?>
    </body>
</html>
