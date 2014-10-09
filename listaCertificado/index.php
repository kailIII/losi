<?php
/**
 * veamos veamos...
 * Obtengo los expediente.idCertificacíon con los cuales puedo buscar los certificacion.idObra y de esta manera
 * obtengo los obrasejecutadas.denominacion (nombre de la obra).
 * Ahora que ya tengo los nombres de las obras puedo recorrer todos los expedientes por cada certificacion.
 * 
 */
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
        <?php
        include_once "../includes/php/header.php";
        /* Cargo todos los expedientes para procesarlos y generar el listado. 
         * Para poder procesar los datos obtenidos de la bases, voy a necesitar un for anidado,
         * dado que con uno se controlara la cantidad de expedientes de una obra y con el otro
         * la cantidad de obras que hay en la base.
         */
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" class="form-control" id="filtro" name="filtro" placeholder="Filtro de Obra" 
                           data-toggle="tooltip" title="Filtro de Obra" alt="Filtro de Obra"
                           onkeyup="ajax_showOptionsFiltro(this, 'getFiltroByLetters', event);" />
                    <input type="hidden" name="filtro_ID" id="filtro_hidden" value="" />
                </div>
                <div class="col-lg-2">
                    <a href="#" class="btn btn-large btn-block btn-primary" onclick="filtro()">Filtrar</a>
                </div>
                <div class="col-lg-2">
                    <a href="../historiaCertificado/actualizacion.php" class="btn btn-large btn-block btn-primary">Actualizar</a>
                </div>
            </div>
            

            <br>
            <legend>Certificados</legend>
            <ul class="nav nav-tabs" role="tablist">
                <li class="active">
                    <a href="#">Filtro por comitente</a>
                </li>
                <li>
                    <a href="#">Filtro por obra</a>
                </li>
            </ul>
            
            <div class="panel panel-default">
                <!--<div class="panel-heading">Filtro por comitente</div>-->
                <div class="panel-body">
                    <?php
                    $oMysqlComitente = $oMysql->getComitenteActiveRecord();
                    $oComitente = new ComitenteValueObject();
                    $oComitente = $oMysqlComitente->buscarTodo();
                    foreach ($oComitente as $aComitente) {
                        ?>
                        <div class="col-lg-4">
                            <input type="checkbox" class="checkbox checkbox-inline" name="comitente" id="comitente<?php echo $aComitente->getId(); ?>" value="<?php echo $aComitente->getId(); ?>" onchange="cambio()"> &nbsp; <?php echo utf8_encode($aComitente->getDescripcion()); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>                               
            <div id="listado">
                <?php include 'todo.php'; ?>
            </div>
        </div>
        <div id="divResultado"></div>
        <?php include_once "../includes/php/footer.php"; ?>
        <?php include_once "../includes/php/flatui_js.php"; ?>
        <script src="js/ajax-dynamic-list.js" type="text/javascript"></script>
        <script src="js/ajax.js" type="text/javascript"></script>
    </body>
</html>
