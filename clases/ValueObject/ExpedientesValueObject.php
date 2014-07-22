<?php
/**
 * Description of ExpedientesValueObject
 *
 * @author Martin
 * @copyright (c) 2014, Martin Remedi
 */
class ExpedientesValueObject {
    private $idexpediente, $idObra, $idTipo, $certNro, $certDnv, $expDpv, $expDnv,
            $mes, $comentario, $importe, $vencimiento, $cedido, $finalizado, $fechaFirma;
    
    public function getIdexpediente() {
        return $this->idexpediente;
    }

    public function getIdObra() {
        return $this->idObra;
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function getCertNro() {
        return $this->certNro;
    }

    public function getCertDnv() {
        return $this->certDnv;
    }

    public function getExpDpv() {
        return $this->expDpv;
    }

    public function getExpDnv() {
        return $this->expDnv;
    }

    public function getMes() {
        return $this->mes;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function getImporte() {
        return $this->importe;
    }

    public function getVencimiento() {
        return $this->vencimiento;
    }

    public function getCedido() {
        return $this->cedido;
    }

    public function getFinalizado() {
        return $this->finalizado;
    }

    public function setIdexpediente($idexpediente) {
        $this->idexpediente = $idexpediente;
    }

    public function setIdObra($idObra) {
        $this->idObra = $idObra;
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    public function setCertNro($certNro) {
        $this->certNro = $certNro;
    }

    public function setCertDnv($certDnv) {
        $this->certDnv = $certDnv;
    }

    public function setExpDpv($expDpv) {
        $this->expDpv = $expDpv;
    }

    public function setExpDnv($expDnv) {
        $this->expDnv = $expDnv;
    }

    public function setMes($mes) {
        $this->mes = $mes;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function setVencimiento($vencimiento) {
        $this->vencimiento = $vencimiento;
    }

    public function setCedido($cedido) {
        $this->cedido = $cedido;
    }

    public function setFinalizado($finalizado) {
        $this->finalizado = $finalizado;
    }

    public function getFechaFirma() {
        return $this->fechaFirma;
    }

    public function setFechaFirma($fechaFirma) {
        $this->fechaFirma = $fechaFirma;
    }
}
