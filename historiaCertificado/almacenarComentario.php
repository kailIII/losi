<?php
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$error = 0;
mysql_query('BEGIN;');

/* 1° Guardo Historico */
$oMysqlExpHistoria = $oMysql->getExpHistotiaActiveRecord();
$oExpHisotoria = new ExpHistoriaValueObject();
$oExpHisotoria->setIdexpediente($_POST['idexpe']);
$oExpHisotoria->setFecha(date('Y-m-d H:i:s'));
$oExpHisotoria->setComentario($_POST['comentario']);
$oExpHisotoria->setDependencia('99999999');

if (!$oMysqlExpHistoria->guardar($oExpHisotoria)) {
    $error = 1;
}
/* Finalizacion de almacenamiento del historico. */

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
        <a href="../listaCertificado/" class="form-control" >Los Datos No Han Sido Almacenados.</a>
        <span class="input-icon fui-check-inverted"></span>
    </div>
    <?php
}