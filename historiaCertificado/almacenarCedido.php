<?php
include_once '../inicio/valido.php';
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$oExpedientes = new ExpedientesValueObject();
$oMysqlExpedientes = $oMysql->getExpedientesActiveRecord();
$oExpedientes->setIdexpediente($_POST['idexpe']);
$oExpedientes->setCedido($_POST['cedido']);

$error = 0;
mysql_query('BEGIN;');

if (!$oMysqlExpedientes->actualizarCedido($oExpedientes)) {
    $error ++;
}

/* Finalizacion de almacenamiento de vialidad. */
if ($error == 0) {
    mysql_query("COMMIT;");
    ?>
    <div class="form-group has-success">
        <a href="../listaCertificado/" class="form-control" >Los Datos Se Grabaron Correctamente</a>
        <span class="input-icon fui-check-inverted"></span>
    </div>
    <?php
} else {
    mysql_query("ROLLBACK;");
    ?>
    <div class="form-group has-error">
        <?php if ($error == 1) { ?>
                        <!--<input type="text" value="Error al guardar la dependencia." class="form-control">-->
            <a href="../listaCertificado/" class="form-control" >Error al guardar la dependencia.</a>
        <?php } elseif ($error == 2) {
            ?>
            <!--<input type="text" value="Error al actualizar los datos." class="form-control">-->
            <a href="../listaCertificado/" class="form-control" >Error al actualizar los datos.</a>
        <?php } else {
            ?>
            <!--<input type="text" value="Los Datos No Han Sido Almacenados" class="form-control">-->
            <a href="../listaCertificado/" class="form-control" >Los Datos No Han Sido Almacenados.</a>
        <?php } ?>
        <span class="input-icon fui-check-inverted"></span>
    </div>
    <?php
}