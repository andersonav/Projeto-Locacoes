<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evento
 *
 * @author anderson.alves
 */
class Evento {

    public function __construct() {
        
    }

    public $idEvento;
    public $nomeEvento;
    public $descricaoEvento;
    public $solicitanteEvento;
    public $dataInicioEvento;
    public $dataFimEvento;
    public $ambienteIdEvento;
    private $ambienteDescricaoEvento;
    public $blocoIdEvento;
    private $blocoDescricaoEvento;
    public $setorIdEvento;
    private $setorDescricaoEvento;
    public $tipoRepeticaoIdEvento;
    private $tipoRepeticaoDescricaoEvento;
    public $colorIdEvento;
    public $colorDescricaoEvento;

    function getIdEvento() {
        return $this->idEvento;
    }

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

    function getBlocoIdEvento() {
        return $this->blocoIdEvento;
    }

    function getBlocoDescricaoEvento() {
        return $this->blocoDescricaoEvento;
    }

    function getSetorIdEvento() {
        return $this->setorIdEvento;
    }

    function getSetorDescricaoEvento() {
        return $this->setorDescricaoEvento;
    }

    function getTipoRepeticaoIdEvento() {
        return $this->tipoRepeticaoIdEvento;
    }

    function getTipoRepeticaoDescricaoEvento() {
        return $this->tipoRepeticaoDescricaoEvento;
    }

    function getColorIdEvento() {
        return $this->colorIdEvento;
    }

    function getColorDescricaoEvento() {
        return $this->colorDescricaoEvento;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
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

    function setBlocoIdEvento($blocoIdEvento) {
        $this->blocoIdEvento = $blocoIdEvento;
    }

    function setBlocoDescricaoEvento($blocoDescricaoEvento) {
        $this->blocoDescricaoEvento = $blocoDescricaoEvento;
    }

    function setSetorIdEvento($setorIdEvento) {
        $this->setorIdEvento = $setorIdEvento;
    }

    function setSetorDescricaoEvento($setorDescricaoEvento) {
        $this->setorDescricaoEvento = $setorDescricaoEvento;
    }

    function setTipoRepeticaoIdEvento($tipoRepeticaoIdEvento) {
        $this->tipoRepeticaoIdEvento = $tipoRepeticaoIdEvento;
    }

    function setTipoRepeticaoDescricaoEvento($tipoRepeticaoDescricaoEvento) {
        $this->tipoRepeticaoDescricaoEvento = $tipoRepeticaoDescricaoEvento;
    }

    function setColorIdEvento($colorIdEvento) {
        $this->colorIdEvento = $colorIdEvento;
    }

    function setColorDescricaoEvento($colorDescricaoEvento) {
        $this->colorDescricaoEvento = $colorDescricaoEvento;
    }

}
