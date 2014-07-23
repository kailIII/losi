<?php
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$error = 0;
mysql_query('BEGIN;');
$oMysqlExpedientes = $oMysql->getExpedientesActiveRecord();
$oExpedientes = new ExpedientesValueObject();

$oExpedientes->setIdObra($_POST['idobra']);
$oExpedientes->setCertNro($_POST['nrocert']);
$oExpedientes->setIdTipo($_POST['tipocertf']);
$oExpedientes->setMes($_POST['periodo']);
$oExpedientes->setComentario($_POST['comentarioExpediente']);
$oExpedientes->setCertDnv($_POST['dnvCertificado']);
$oExpedientes->setExpDpv($_POST['dpvExpediente']);
$oExpedientes->setExpDnv($_POST['dnvExpediente']);
$oExpedientes->setImporte($_POST['importeExpediente']);
$oExpedientes->setVencimiento($_POST['vencimientoExpediente']);
$oExpedientes->setCedido($_POST['cedidoExpediente']);
$oExpedientes->setFinalizado('N');
$oExpedientes->setFechaFirma($_POST['fechaFirma']);


/* Grabacion del expediente. */
if($oMysqlExpedientes->existe($oExpedientes)){
    if(!$oMysqlExpedientes->actualizar($oExpedientes)){
        $error = 1;
    }
} else {
    if(!$oMysqlExpedientes->guardar($oExpedientes)){
        $error = 2;
    }
}
if($error == 0){
    mysql_query("COMMIT;");
    ?>
    <div class="form-group has-success">
        <div class="col-xs6">
            <input type="text" value="Los Datos Se Grabaron Correctamente" class="form-control">
            <span class="input-icon fui-check-inverted"></span>
        </div>
    </div>
    <?php
} else {
    mysql_query("ROLLBACK;");
    ?>
    <div class="form-group has-error">
        <div class="col-xs6">
            <input type="text" value="Los Datos No Han Sido Almacenados" class="form-control">
            <span class="input-icon fui-check-inverted"></span>
        </div>
    </div>
    <?php
}