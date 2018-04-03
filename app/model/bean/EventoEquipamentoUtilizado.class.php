<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoEquipamentoUtilizado
 *
 * @author anderson.alves
 */
class EventoEquipamentoUtilizado {

    public function __construct() {
        
    }

    private $idEventoEquipamentoUtilizado;
    private $descricaoEventoEquipamentoUtilizado;
    private $dataInicioEquipamentoUtilizado;
    private $dataFimEquipamentoUtilizado;
    private $qtdEventoEquipamentoUtilizado;
    private $qtdDisponivelEquipamento;
    private $idEquipamento;

    function getIdEventoEquipamentoUtilizado() {
        return $this->idEventoEquipamentoUtilizado;
    }

    function getDescricaoEventoEquipamentoUtilizado() {
        return $this->descricaoEventoEquipamentoUtilizado;
    }

    function getDataInicioEquipamentoUtilizado() {
        return $this->dataInicioEquipamentoUtilizado;
    }

    function getDataFimEquipamentoUtilizado() {
        return $this->dataFimEquipamentoUtilizado;
    }

    function getQtdEventoEquipamentoUtilizado() {
        return $this->qtdEventoEquipamentoUtilizado;
    }

    function getIdEquipamento() {
        return $this->idEquipamento;
    }

    function getQtdDisponivelEquipamento() {
        return $this->qtdDisponivelEquipamento;
    }

    function setIdEventoEquipamentoUtilizado($idEventoEquipamentoUtilizado) {
        $this->idEventoEquipamentoUtilizado = $idEventoEquipamentoUtilizado;
    }

    function setDescricaoEventoEquipamentoUtilizado($descricaoEventoEquipamentoUtilizado) {
        $this->descricaoEventoEquipamentoUtilizado = $descricaoEventoEquipamentoUtilizado;
    }

    function setQtdEventoEquipamentoUtilizado($qtdEventoEquipamentoUtilizado) {
        $this->qtdEventoEquipamentoUtilizado = $qtdEventoEquipamentoUtilizado;
    }

    function setDataInicioEquipamentoUtilizado($dataInicioEquipamentoUtilizada) {
        $this->dataInicioEquipamentoUtilizado = $dataInicioEquipamentoUtilizada;
    }

    function setDataFimEquipamentoUtilizado($dataFimEquipamentoUtilizada) {
        $this->dataFimEquipamentoUtilizado = $dataFimEquipamentoUtilizada;
    }

    function setQtdDisponivelEquipamento($qtdDisponivelEquipamento) {
        $this->qtdDisponivelEquipamento = $qtdDisponivelEquipamento;
    }

    function setIdEquipamento($idEquipamento) {
        $this->idEquipamento = $idEquipamento;
    }

}
