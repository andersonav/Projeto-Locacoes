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
    public $telefoneSolicitante;
    public $emailSolicitante;
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
    public $aulaIdEvento;
    private $aulaDescricaoEvento;
    public $nomeProfessorEvento;
    public $equipamentoIdEvento;
    public $equipamentoDescricaoEvento;
    public $equipamentoQtdUtilizadaEvento;
    public $diaSemanaDescricao;
    public $eventoRandom;
    public $idFiltroEvento;

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

    function getAulaIdEvento() {
        return $this->aulaIdEvento;
    }

    function getAulaDescricaoEvento() {
        return $this->aulaDescricaoEvento;
    }

    function getNomeProfessorEvento() {
        return $this->nomeProfessorEvento;
    }

    function getEquipamentoIdEvento() {
        return $this->equipamentoIdEvento;
    }

    function getEquipamentoDescricaoEvento() {
        return $this->equipamentoDescricaoEvento;
    }

    function getEquipamentoQtdUtilizadaEvento() {
        return $this->equipamentoQtdUtilizadaEvento;
    }

    function getDiaSemanaDescricao() {
        return $this->diaSemanaDescricao;
    }

    function getEventoRandom() {
        return $this->eventoRandom;
    }

    function getIdFiltroEvento() {
        return $this->idFiltroEvento;
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

    function setAulaIdEvento($aulaIdEvento) {
        $this->aulaIdEvento = $aulaIdEvento;
    }

    function setAulaDescricaoEvento($aulaDescricaoEvento) {
        $this->aulaDescricaoEvento = $aulaDescricaoEvento;
    }

    function setNomeProfessorEvento($nomeProfessorEvento) {
        $this->nomeProfessorEvento = $nomeProfessorEvento;
    }

    function setEquipamentoIdEvento($equipamentoIdEvento) {
        $this->equipamentoIdEvento = $equipamentoIdEvento;
    }

    function setEquipamentoDescricaoEvento($equipamentoDescricaoEvento) {
        $this->equipamentoDescricaoEvento = $equipamentoDescricaoEvento;
    }

    function setEquipamentoQtdUtilizadaEvento($equipamentoQtdUtilizadaEvento) {
        $this->equipamentoQtdUtilizadaEvento = $equipamentoQtdUtilizadaEvento;
    }

    function setDiaSemanaDescricao($diaSemanaDescricao) {
        $this->diaSemanaDescricao = $diaSemanaDescricao;
    }

    function setEventoRandom($eventoRandom) {
        $this->eventoRandom = $eventoRandom;
    }

    function setIdFiltroEvento($idFiltroEvento) {
        $this->idFiltroEvento = $idFiltroEvento;
    }

}
