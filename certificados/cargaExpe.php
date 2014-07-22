<?php
include_once '../inicio/valido.php';
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();

$oMysqlExpedientes = $oMysql->getExpedientesActiveRecord();
$oExpedientes = new ExpedientesValueObject();
$oExpedientes->setCertNro($_POST['certNro']);
$oExpedientes->setIdObra($_POST['idobra']);

$oExpedientes = $oMysqlExpedientes->buscarPorCertNroyObra($oExpedientes);
if(!$oExpedientes){
    ?>
    <input type="hidden" name="expe00" id="expe00" value="No" />
    <?php
} else {
    ?>
    <input type="hidden" name="expe00" id="expe00" value="Si" />
    <input type="hidden" name="expe01" id="expe01" value="<?php echo $oExpedientes->getIdexpediente(); ?>" />
    <input type="hidden" name="expe02" id="expe02" value="<?php echo $oExpedientes->getIdObra(); ?>" />

    <input type="hidden" name="expe03" id="expe03" value="<?php echo $oExpedientes->getIdTipo(); ?>" />
    <input type="hidden" name="expe04" id="expe04" value="<?php echo $oExpedientes->getCertNro(); ?>" />
    <input type="hidden" name="expe05" id="expe05" value="<?php echo $oExpedientes->getCertDnv(); ?>" />

    <input type="hidden" name="expe06" id="expe06" value="<?php echo $oExpedientes->getExpDpv(); ?>" />
    <input type="hidden" name="expe07" id="expe07" value="<?php echo $oExpedientes->getExpDnv(); ?>" />
    <input type="hidden" name="expe08" id="expe08" value="<?php echo $oExpedientes->getMes(); ?>" />

    <input type="hidden" name="expe09" id="expe09" value="<?php echo $oExpedientes->getComentario(); ?>" />
    <input type="hidden" name="expe10" id="expe10" value="<?php echo $oExpedientes->getImporte(); ?>" />
    <input type="hidden" name="expe11" id="expe11" value="<?php echo $oExpedientes->getVencimiento(); ?>" />

    <input type="hidden" name="expe12" id="expe12" value="<?php echo $oExpedientes->getCedido(); ?>" />
    <input type="hidden" name="expe13" id="expe13" value="<?php echo $oExpedientes->getFinalizado(); ?>" />
    <input type="hidden" name="expe14" id="expe14" value="<?php echo $oExpedientes->getFechaFirma(); ?>" />
    <?php
}