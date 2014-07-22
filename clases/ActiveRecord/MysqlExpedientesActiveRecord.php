<?php
include_once 'activeRecordInterface.php';
include_once '../clases/ValueObject/ExpedientesValueObject.php';
/**
 * Description of MysqlExpedientesActiveRecord
 *
 * @author Martin
 */
class MysqlExpedientesActiveRecord implements ActiveRecord {
    public function actualizar($oValueObject) {
        
    }

    public function borrar($oValueObject) {
        
    }

    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean|\ExpedientesValueObject
     */
    public function buscar($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE idexpediente = " . $oValueObject->getIdexpediente() . ";";
        $resultado = mysql_query($sql);
        if($resultado){
            $fila = mysql_fetch_object($resultado);
            $oValueObject = new ExpedientesValueObject();
            $oValueObject->setIdexpediente($fila->idexpediente);
            $oValueObject->setIdObra($fila->idObra);
            $oValueObject->setCertNro($fila->certNro);
            $oValueObject->setCertDnv($fila->certDnv);
            $oValueObject->setExpDpv($fila->expDpv);
            $oValueObject->setExpDnv($fila->expDnv);
            $oValueObject->setMes($fila->mes);
            $oValueObject->setComentario($fila->comentario);
            $oValueObject->setImporte($fila->importe);
            $oValueObject->setVencimiento($fila->vencimiento);
            $oValueObject->setCedido($fila->cedido);
            $oValueObject->setFinalizado($fila->finalizado);
            $oValueObject->setFechaFirma($fila->fechaFirma);
            return $oValueObject;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @return boolean|\ExpedientesValueObject
     */
    public function buscarTodo() {
        $sql = "SELECT * FROM expedientes;";
        $resultado = mysql_query($sql);
        if($resultado){
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)){
                $oExpedientes = new ExpedientesValueObject();
                $oExpedientes->setIdexpediente($fila->idexpediente);
                $oExpedientes->setIdObra($fila->idObra);
                $oExpedientes->setCertNro($fila->certNro);
                $oExpedientes->setCertDnv($fila->certDnv);
                $oExpedientes->setExpDpv($fila->expDpv);
                $oExpedientes->setExpDnv($fila->expDnv);
                $oExpedientes->setMes($fila->mes);
                $oExpedientes->setComentario($fila->comentario);
                $oExpedientes->setImporte($fila->importe);
                $oExpedientes->setVencimiento($fila->vencimiento);
                $oExpedientes->setCedido($fila->cedido);
                $oExpedientes->setFinalizado($fila->finalizado);
                $oExpedientes->setFechaFirma($fila->fechaFirma);
                $aExpedientes[] = $oExpedientes;
                unset($oExpedientes);
            }
            return $aExpedientes;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function buscarPorCertNroyObra($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE certNro = '" . $oValueObject->getCertNro() . "' "
                . "AND idObra = " . $oValueObject->getIdObra() . ";";
        $resultado = mysql_query($sql);
        if($fila = mysql_fetch_object($resultado)){
            $oValueObject = new ExpedientesValueObject();
            $oValueObject->setIdexpediente($fila->idexpediente);
            $oValueObject->setIdObra($fila->idObra);
            $oValueObject->setCertNro($fila->certNro);
            $oValueObject->setCertDnv($fila->certDnv);
            $oValueObject->setExpDpv($fila->expDpv);
            $oValueObject->setExpDnv($fila->expDnv);
            $oValueObject->setMes($fila->mes);
            $oValueObject->setComentario($fila->comentario);
            $oValueObject->setImporte($fila->importe);
            $oValueObject->setVencimiento($fila->vencimiento);
            $oValueObject->setCedido($fila->cedido);
            $oValueObject->setFinalizado($fila->finalizado);
            $oValueObject->setFechaFirma($fila->fechaFirma);
            return $oValueObject;
        } else {
            return false;
        }
    }
    public function contar() {
        
    }

    public function existe($oValueObject) {
        
    }

    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function guardar($oValueObject) {
        $sql = "INSERT INTO expedientes (idObra, idTipo, certNro, certDnv, "
                . "expDpv, expDnv, mes, comentario, importe, vencimiento, cedido, finalizado, fechaFirma)";
        $sql.= " VALUE(" . $oValueObject->getIdObra() ;
        $sql.= ", " . $oValueObject->getIdTipo();
        $sql.= ", '" . $oValueObject->getCertNro() . "'";
        $sql.= ", '" . $oValueObject->getCertDnv() . "'";
        $sql.= ", '" . $oValueObject->getExpDpv() . "'";
        $sql.= ", '" . $oValueObject->getExpDnv() . "'";
        $sql.= ", '" . $oValueObject->getMes() . "'";
        $sql.= ", '" . $oValueObject->getComentario() . "'";
        $sql.= ", '" . $oValueObject->getImporte() . "'";
        $sql.= ", '" . $oValueObject->getVencimiento() . "'";
        $sql.= ", '" . $oValueObject->getCedido() . "'";
        $sql.= ", '" . $oValueObject->getFinalizado() . "'";
        $sql.= ", '" . $oValueObject->getFechaFirma() . "'";
        $sql.=");";
//        $resultado = mysql_query($sql) or die(mysql_error());
        $resultado = mysql_query($sql) or die(false);
        if($resultado){
            $result = mysql_query("SELECT DISTINCT LAST_INSERT_ID() FROM expediente");
            $id = mysql_fetch_array($result);
            if($id[0]<>0) {
                $oValueObject->setIdexpediente($id[0]);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
