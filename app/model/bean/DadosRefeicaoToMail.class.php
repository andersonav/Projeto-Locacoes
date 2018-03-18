<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosRefeicaoToMail
 *
 * @author anderson.alves
 */
class DadosRefeicaoToMail {

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
    public $refeicaoDescricaoEvento;
    public $refeicaoQtdUtilizadaEvento;
    public $refeicaoEmailResponsavelEvento;
    public $refeicaoDataInicio;
    public $refeicaoDataFim;

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

    function getRefeicaoDescricaoEvento() {
        return $this->refeicaoDescricaoEvento;
    }

    function getRefeicaoQtdUtilizadaEvento() {
        return $this->refeicaoQtdUtilizadaEvento;
    }

    function getRefeicaoEmailResponsavelEvento() {
        return $this->refeicaoEmailResponsavelEvento;
    }
    
    function getRefeicaoDataInicio() {
        return $this->refeicaoDataInicio;
    }

    function getRefeicaoDataFim() {
        return $this->refeicaoDataFim;
    }

    function setNomeEvento($nomeEvento) {
        $this->nomeEvento = $nomeEvento;
    }

    function setDescricaoEvento($descricaoEvento) {
        $this->descricaoEvento = $descricaoEvento;
    }

    function setSolicitanteEvento($solicitanteEvento) {
        $this->solicitanteEvento = $solicitanteEvento;
    }
    
    function setTelefoneSolicitante($telefoneSolicitante) {
        $this->telefoneSolicitante = $telefoneSolicitante;
    }

    function setEmailSolicitante($emailSolicitante) {
        $this->emailSolicitante = $emailSolicitante;
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

    function setRefeicaoDescricaoEvento($refeicaoDescricaoEvento) {
        $this->refeicaoDescricaoEvento = $refeicaoDescricaoEvento;
    }

    function setRefeicaoQtdUtilizadaEvento($refeicaoQtdUtilizadaEvento) {
        $this->refeicaoQtdUtilizadaEvento = $refeicaoQtdUtilizadaEvento;
    }

    function setRefeicaoEmailResponsavelEvento($refeicaoEmailResponsavelEvento) {
        $this->refeicaoEmailResponsavelEvento = $refeicaoEmailResponsavelEvento;
    }
    
    function setRefeicaoDataInicio($refeicaoDataInicio) {
        $this->refeicaoDataInicio = $refeicaoDataInicio;
    }

    function setRefeicaoDataFim($refeicaoDataFim) {
        $this->refeicaoDataFim = $refeicaoDataFim;
    }

}
