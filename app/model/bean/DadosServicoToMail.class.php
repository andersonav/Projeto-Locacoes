<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosServicoToMail
 *
 * @author anderson.alves
 */
class DadosServicoToMail {

    public function __construct() {
        
    }

    public $nomeEvento;
    public $descricaoEvento;
    public $solicitanteEvento;
    public $dataInicioEvento;
    public $dataFimEvento;
    public $ambienteIdEvento;
    private $ambienteDescricaoEvento;
    public $servicoDescricaoEvento;
    public $servicoEmailResponsavelEvento;
    public $servicoDataInicio;
    public $servicoDataFim;

    function getNomeEvento() {
        return $this->nomeEvento;
    }

    function getDescricaoEvento() {
        return $this->descricaoEvento;
    }

    function getSolicitanteEvento() {
        return $this->solicitanteEvento;
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

    function getServicoDescricaoEvento() {
        return $this->servicoDescricaoEvento;
    }

    function getServicoEmailResponsavelEvento() {
        return $this->servicoEmailResponsavelEvento;
    }

    function getServicoDataInicio() {
        return $this->servicoDataInicio;
    }

    function getServicoDataFim() {
        return $this->servicoDataFim;
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

    function setServicoDescricaoEvento($servicoDescricaoEvento) {
        $this->servicoDescricaoEvento = $servicoDescricaoEvento;
    }

    function setServicoEmailResponsavelEvento($servicoEmailResponsavelEvento) {
        $this->servicoEmailResponsavelEvento = $servicoEmailResponsavelEvento;
    }

    function setServicoDataInicio($servicoDataInicio) {
        $this->servicoDataInicio = $servicoDataInicio;
    }

    function setServicoDataFim($servicoDataFim) {
        $this->servicoDataFim = $servicoDataFim;
    }

}
