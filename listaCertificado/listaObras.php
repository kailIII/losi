<?php
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();
$oMyObra = $oMysql->getObrasEjecutadasActiveRecord();
$oObra = new ObrasEjecutadasValueObject();

if (isset($_GET['getFiltroByLetters']) && isset($_GET['letters'])) {
    $letters = $_GET['letters'];
//    $letters = preg_replace("/[^a-z0-9 ]/si", "", $letters);
    $oObra->setDenominacion($letters);
    $oObra = $oMyObra->buscarPorDenominacion($oObra);
    foreach ($oObra as $aObra) {
        echo $aObra->getID() . "###" . htmlentities($aObra->getDenominacion()) . "|";
    }
}