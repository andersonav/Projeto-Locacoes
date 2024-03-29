<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoRefeicaoUtilizado
 *
 * @author anderson.alves
 */
class EventoRefeicaoUtilizado {

    public function __construct() {
        
    }

    private $idEventoRefeicaoUtilizado;
    private $descricaoEventoRefeicaoUtilizado;
    private $dataInicioRefeicaoUtilizado;
    private $dataFimRefeicaoUtilizado;
    private $qtdEventoRefeicaoUtilizado;
    private $idRefeicao;
    private $idEvento;

    function getIdEventoRefeicaoUtilizado() {
        return $this->idEventoRefeicaoUtilizado;
    }

    function getDescricaoEventoRefeicaoUtilizado() {
        return $this->descricaoEventoRefeicaoUtilizado;
    }

    function getDataInicioRefeicaoUtilizado() {
        return $this->dataInicioRefeicaoUtilizado;
    }

    function getDataFimRefeicaoUtilizado() {
        return $this->dataFimRefeicaoUtilizado;
    }

    function getQtdEventoRefeicaoUtilizado() {
        return $this->qtdEventoRefeicaoUtilizado;
    }

    function getIdRefeicao() {
        return $this->idRefeicao;
    }

    function getIdEvento() {
        return $this->idEvento;
    }

    function setIdEventoRefeicaoUtilizado($idEventoRefeicaoUtilizado) {
        $this->idEventoRefeicaoUtilizado = $idEventoRefeicaoUtilizado;
    }

    function setDescricaoEventoRefeicaoUtilizado($descricaoEventoRefeicaoUtilizado) {
        $this->descricaoEventoRefeicaoUtilizado = $descricaoEventoRefeicaoUtilizado;
    }

    function setQtdEventoRefeicaoUtilizado($qtdEventoRefeicaoUtilizado) {
        $this->qtdEventoRefeicaoUtilizado = $qtdEventoRefeicaoUtilizado;
    }

    function setDataInicioRefeicaoUtilizado($dataInicioRefeicaoUtilizada) {
        $this->dataInicioRefeicaoUtilizado = $dataInicioRefeicaoUtilizada;
    }

    function setDataFimRefeicaoUtilizado($dataFimRefeicaoUtilizada) {
        $this->dataFimRefeicaoUtilizado = $dataFimRefeicaoUtilizada;
    }

    function setIdRefeicao($idRefeicao) {
        $this->idRefeicao = $idRefeicao;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

}
