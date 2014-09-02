<?php
include_once '../inicio/valido.php';
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$oExpedientes = new ExpedientesValueObject();
$oMysqlExpedientes = $oMysql->getExpedientesActiveRecord();
$oExpedientes->setIdexpediente($_POST['idexpe']);

$error = 0;
mysql_query('BEGIN;');

if (!$oMysqlExpedientes->finalizar($oExpedientes)) {
    $error ++;
}

/* Finalizacion de almacenamiento de vialidad. */
if ($error == 0) {
    mysql_query("COMMIT;");
    ?>
    <div class="form-group has-success">
<!--        <div>-->
            <a href="../listaCertificado/" class="form-control" >El Expediente ha sido finalizado.</a>
            <span class="input-icon fui-check-inverted"></span>
        <!--</div>-->
    </div>
    <?php
} else {
    mysql_query("ROLLBACK;");
    ?>
    <div class="form-group has-error">
        <a href="../listaCertificado/" class="form-control" >Error al finalizar el expediente.</a>
    </div>
    <?php
}