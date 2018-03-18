<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EvenDadosEquipamentoToMail
 *
 * @author anderson.alves
 */
class DadosEquipamentoToMail {

    public function __construct() {
        
    }

    public $nomeEvento;
    public $descricaoEvento;
    public $solicitanteEvento;
    public $telefoneSolicitante;
    public $emailSolicitante;
    public $dataInicioEvento;
    public $dataFimEvento;
    public $ambienteIdEvento;
    private $ambienteDescricaoEvento;
    public $equipamentoDescricaoEvento;
    public $equipamentoQtdUtilizadaEvento;
    public $equipamentoEmailResponsavelEvento;
    public $equipamentoDataInicio;
    public $equipamentoDataFim;

    function getNomeEvento() {
        return $this->nomeEvento;
    }

    function getDescricaoEvento() {
        return $this->descricaoEvento;
    }

    function getSolicitanteEvento() {
        return $this->solicitanteEvento;
    }

    function getTelefoneSolicitante() {
        return $this->telefoneSolicitante;
    }

    function getEmailSolicitante() {
        return $this->emailSolicitante;
    }

    function getDataInicioEvento() {
        return $this->dataInicioEvento;
    }

    function getDataFimEvento() {
        return $this->dataFimEvento;
    }

    function getAmbienteIdEvento() {
        return $this->ambienteIdEvento;
    }

    function getAmbienteDescricaoEvento() {
        return $this->ambienteDescricaoEvento;
    }

    function getEquipamentoDescricaoEvento() {
        return $this->equipamentoDescricaoEvento;
    }

    function getEquipamentoQtdUtilizadaEvento() {
        return $this->equipamentoQtdUtilizadaEvento;
    }

    function getEquipamentoEmailResponsavelEvento() {
        return $this->equipamentoEmailResponsavelEvento;
    }

    function getEquipamentoDataInicio() {
        return $this->equipamentoDataInicio;
    }

    function getEquipamentoDataFim() {
        return $this->equipamentoDataFim;
    }

    function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }

    function setTelefoneSolicitante($telefoneSolicitante) {
        $this->telefoneSolicitante = $telefoneSolicitante;
    }

    function setEmailSolicitante($emailSolicitante) {
        $this->emailSolicitante = $emailSolicitante;
    }

    function setDescricaoEvento($descricaoEvento) {
        $this->descricaoEvento = $descricaoEvento;
    }

    function setSolicitanteEvento($solicitanteEvento) {
        $this->solicitanteEvento = $solicitanteEvento;
    }

    function setDataInicioEvento($dataInicioEvento) {
        $this->dataInicioEvento = $dataInicioEvento;
    }

    function setDataFimEvento($dataFimEvento) {
        $this->dataFimEvento = $dataFimEvento;
    }

    function setAmbienteIdEvento($ambienteIdEvento) {
        $this->ambienteIdEvento = $ambienteIdEvento;
    }

    function setAmbienteDescricaoEvento($ambienteDescricaoEvento) {
        $this->ambienteDescricaoEvento = $ambienteDescricaoEvento;
    }

    function setEquipamentoDescricaoEvento($equipamentoDescricaoEvento) {
        $this->equipamentoDescricaoEvento = $equipamentoDescricaoEvento;
    }

    function setEquipamentoQtdUtilizadaEvento($equipamentoQtdUtilizadaEvento) {
        $this->equipamentoQtdUtilizadaEvento = $equipamentoQtdUtilizadaEvento;
    }

    function setEquipamentoEmailResponsavelEvento($equipamentoEmailResponsavelEvento) {
        $this->equipamentoEmailResponsavelEvento = $equipamentoEmailResponsavelEvento;
    }

    function setEquipamentoDataInicio($equipamentoDataInicio) {
        $this->equipamentoDataInicio = $equipamentoDataInicio;
    }

    function setEquipamentoDataFim($equipamentoDataFim) {
        $this->equipamentoDataFim = $equipamentoDataFim;
    }

}
