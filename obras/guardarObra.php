<?php
require_once '../clases/ActiveRecord/ActiveRecordAbstractFactory.php';
$oMysql = ActiveRecordAbstractFactory::getActiveRecordFactory(ActiveRecordAbstractFactory::MYSQL);
$oMysql->conectar();
/**
 * Guarda los datos en la tabla de Obras Ejecutadas.
 */
extract($_POST, EXTR_OVERWRITE);
//$identificador = $_POST['identificador'];
//$denominacion=$_POST['denominacion'];
//$comitente=$_POST['comitente'];
//$expediente=$_POST['expediente'];
//$fecha=$_POST['fecha'];
//$importe=$_POST['importe'];
//include_once '../clases/ValueObject/ObrasEjecutadasValueObject.php';
//include_once '../clases/ActiveRecord/MysqlObrasEjecutadasActiveRecord.php';
$oMysqlObras = new MysqlObrasEjecutadasActiveRecord();
$oObras = new ObrasEjecutadasValueObject();
$oObras->setID($identificador);
$oObras->setDenominacion($denominacion);
$oObras->setIdcomitente($comitente);
$oObras->setExpPrincipal($expediente);
$oObras->setFechaInicio($fecha);
$oObras->setMontoContractualOriginal($importe);

if ($oMysqlObras->guardarNombre($oObras)) {
    ?>
    <div class="row has-success">
            <!--<input type="text" value="Los Datos Se Grabaron Correctamente" class="form-control">-->
        <a href="../certificados" class="form-control" >Los Datos Se Grabaron Correctamente.</a>
        <span class="input-icon fui-check-inverted"></span>
    </div>
    <?php
} else {
    ?>
    <div class="row has-error">
        <input type="text" value="Los Datos No Han Sido Almacenados" class="form-control">
        <span class="input-icon fui-check-inverted"></span>
    </div>
    <?php
}