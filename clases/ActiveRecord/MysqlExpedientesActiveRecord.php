<?php

include_once 'activeRecordInterface.php';
include_once '../clases/ValueObject/ExpedientesValueObject.php';

/**
 * Description of MysqlExpedientesActiveRecord
 *
 * @author Martin
 */
class MysqlExpedientesActiveRecord implements ActiveRecord {

    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function actualizar($oValueObject) {
        $sql = "UPDATE expedientes SET idTipo = " . $oValueObject->getIdTipo()
                . ", certNro = '" . $oValueObject->getCertNro() . "'"
                . ", certDnv = '" . $oValueObject->getCertDnv() . "'"
                . ", expDpv = '" . $oValueObject->getExpDpv() . "'"
                . ", expDnv = '" . $oValueObject->getExpDnv() . "'"
                . ", mes = '" . $oValueObject->getMes() . "'"
                . ", comentario = '" . $oValueObject->getComentario() . "'"
                . ", importe = '" . $oValueObject->getImporte() . "'"
                . ", vencimiento = '" . $oValueObject->getVencimiento() . "'"
                . ", cedido = '" . $oValueObject->getCedido() . "'"
                . ", finalizado = '" . $oValueObject->getFinalizado() . "'"
                . ", fechaFirma = '" . $oValueObject->getFechaFirma() . "'"
                . " WHERE certNro = '" . $oValueObject->getCertNro() . "' "
                . "AND idObra = " . $oValueObject->getIdObra() . ";";
        $resultado = mysql_query($sql) or die(false);
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function actualizarCedido($oValueObject) {
        $sql = "UPDATE expedientes SET cedido = '" . $oValueObject->getCedido() . "'"
                . " WHERE idExpediente = " . $oValueObject->getIdexpediente() . ";";
        $resultado = mysql_query($sql) or die(false);
        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function finalizar($oValueObject) {
        $sql = "UPDATE expedientes SET finalizado = 'S'"
                . " WHERE idExpediente = " . $oValueObject->getIdexpediente() . ";";
        $resultado = mysql_query($sql) or die(false);
        if ($resultado) {
            return true;
        } else {
            return false;
        }
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
        if ($resultado) {
            $fila = mysql_fetch_object($resultado);
            $oValueObject = new ExpedientesValueObject();
            $oValueObject->setIdexpediente($fila->idexpediente);
            $oValueObject->setIdObra($fila->idObra);
            $oValueObject->setIdTipo($fila->idTipo);
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
        if (mysql_fetch_object($resultado)) {
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)) {
                $oExpedientes = new ExpedientesValueObject();
                $oExpedientes->setIdexpediente($fila->idexpediente);
                $oExpedientes->setIdObra($fila->idObra);
                $oExpedientes->setIdTipo($fila->idTipo);
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
        if ($fila = mysql_fetch_object($resultado)) {
            $oValueObject = new ExpedientesValueObject();
            $oValueObject->setIdexpediente($fila->idexpediente);
            $oValueObject->setIdObra($fila->idObra);
            $oValueObject->setIdTipo($fila->idTipo);
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
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function buscarPorObra($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE idObra = " . $oValueObject->getIdObra() . ";";
        $resultado = mysql_query($sql);
        if ($resultado) {
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)) {
                $oValueObject = new ExpedientesValueObject();
                $oValueObject->setIdexpediente($fila->idexpediente);
                $oValueObject->setIdObra($fila->idObra);
                $oValueObject->setIdTipo($fila->idTipo);
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
                $aExpedientes[] = $oValueObject;
                unset($oValueObject);
            }
            return $aExpedientes;
        } else {
            return false;
        }
    }

    /**
     * 
     * @param ExpedienteValueObject $oValueObject
     * @return boolean
     */
    public function buscarPorExpDnv($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE expDnv = " . $oValueObject->getExpDnv();
        $resultado = mysql_query($sql);
        if ($resultado) {
            $fila = mysql_fetch_object($resultado);
            $oValueObject->setIdexpediente($fila->idexpediente);
            $oValueObject->setIdObra($fila->idObra);
            $oValueObject->setIdTipo($fila->idTipo);
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
     * El buscarSinfin trae todos los datos que se encuentran en la tabla expediente
     * y los cuales no han sido finalizados.
     */
    public function buscarSinFin() {
        $sql = "SELECT * FROM expedientes WHERE finalizado = 'N';";
        $resultado = mysql_query($sql);
        if ($resultado) {
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)) {
                $oValueObject = new ExpedientesValueObject();
                $oValueObject->setIdexpediente($fila->idexpediente);
                $oValueObject->setIdObra($fila->idObra);
                $oValueObject->setIdTipo($fila->idTipo);
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
                $aExpedientes[] = $oValueObject;
                unset($oValueObject);
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
    public function buscarPorExpediente($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE idexpediente = " . $oValueObject->getIdexpediente() . ";";
        $resultado = mysql_query($sql);
        if ($resultado) {
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)) {
                $oValueObject = new ExpedientesValueObject();
                $oValueObject->setIdexpediente($fila->idexpediente);
                $oValueObject->setIdObra($fila->idObra);
                $oValueObject->setIdTipo($fila->idTipo);
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
                $aExpedientes[] = $oValueObject;
                unset($oValueObject);
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
    public function buscarNoFinalizados() {
        $sql = "SELECT * FROM expedientes WHERE finalizado = 'N' "
                . "ORDER BY idObra, idexpediente;";
        $resultado = mysql_query($sql);
        if ($resultado) {
            $aExpedientes = array();
            while ($fila = mysql_fetch_object($resultado)) {
                $oExpedientes = new ExpedientesValueObject();
                $oExpedientes->setIdexpediente($fila->idexpediente);
                $oExpedientes->setIdObra($fila->idObra);
                $oExpedientes->setIdTipo($fila->idTipo);
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

    public function contar() {
        
    }

    public function existe($oValueObject) {
        $sql = "SELECT * FROM expedientes WHERE certNro = '" . $oValueObject->getCertNro() . "' "
                . "AND idObra = " . $oValueObject->getIdObra() . ";";
        $resultado = mysql_query($sql);
        return mysql_fetch_object($resultado);
    }

    /**
     * 
     * @param ExpedientesValueObject $oValueObject
     * @return boolean
     */
    public function guardar($oValueObject) {
        $sql = "INSERT INTO expedientes (idObra, idTipo, certNro, certDnv, "
                . "expDpv, expDnv, mes, comentario, importe, vencimiento, cedido, finalizado, fechaFirma)";
        $sql.= " VALUE(" . $oValueObject->getIdObra();
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
        if ($resultado) {
            $result = mysql_query("SELECT DISTINCT LAST_INSERT_ID() FROM expediente");
            $id = mysql_fetch_array($result);
            if ($id[0] <> 0) {
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
