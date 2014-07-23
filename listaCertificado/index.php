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
        
//        $oMysqlExpediente = $oMysql->getExpedienteActiveRecord();

        /* Busco los expediente.idCertificacion y los agrego a una lista para 
         * poder buscar los nombres de las obras y poder recorrerlo. */
//        $oExpedientes = $oMysqlExpediente->buscarIdCertificaciones();
//        $lista = '';
//        foreach ($oExpedientes as $expediente) {
//            $lista .= $expediente->getIdCertificacion().',';
//        }
//        $lista = substr($lista, 0, strlen($lista)-1);
//        $lista = explode(',', $lista);
        /* En $lista poseo los idCertificacion. */
        
//        $oMysqlObra = $oMysql->getObrasEjecutadasActiveRecord();
//        $oMysqlCertificacion = $oMysql->getCertificacionActiveRecord();
//        include_once '../clases/ValueObject/CertificacionValueObject.php';
//        $oCertificacion = new CertificacionValueObject();

        /* Cargo todas las dependencias para poder consultarlas cuando necesite. */
//        $dependencia = array();
//        $oMysqlDependencia = $oMysql->getDependenciaActiveRecord();
//        $oDependencia = new DependenciaValueObject();
//        $oDependencia = $oMysqlDependencia->buscarTodo();
//        foreach ($oDependencia as $auxDep) {
//            $dependencia[$auxDep->getIddependencia()] = $auxDep->getDependencia();
//        }
//        $totalfinal = 0;
        ?>
        <div class="container">
            <div class="form-group">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <a href="../historiaCertificado/actualizacion.php" class="btn btn-large btn-block btn-primary">Actualizar</a>
                </div>
            </div>
            <legend>Certificados</legend>
            <div class="panel panel-default">
              <div class="panel-heading">Filtro por comitente</div>
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
                <?php include './todo.php';?>
            </div>
        </div>
        <div id="divResultado"></div>
        <?php include_once "../includes/php/footer.php";?>
        <?php include_once "../includes/php/flatui_js.php";?>
    </body>
</html>
