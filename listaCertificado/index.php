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
            <div class="form-group">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <a href="../historiaCertificado/actualizacion.php" class="btn btn-large btn-block btn-primary">Actualizar</a>
                </div>
            </div>
            <legend>Certificados</legend>
            <div class="row">
            <div class="form-group">
                <div class="col-lg-12">
                    <label class="control-label"> Comitente </label><br />
                </div>
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
            <div class="row" id="listado">
                <?php include './todo.php';?>
            </div>
        </div>
        <div id="divResultado"></div>
        <?php include_once "../includes/php/footer.php";?>
        <?php include_once "../includes/php/flatui_js.php";?>
    </body>
</html>
