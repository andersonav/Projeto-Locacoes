<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoServicoUtilizado
 *
 * @author anderson.alves
 */
class EventoServicoUtilizado {

    public function __construct() {
        
    }

    private $idEventoServicoUtilizado;
    private $descricaoEventoServicoUtilizado;
    private $dataInicioServicoUtilizado;
    private $dataFimServicoUtilizado;
    private $idServico;
    private $idEvento;

    function getIdEventoServicoUtilizado() {
        return $this->idEventoServicoUtilizado;
    }

    function getDescricaoEventoServicoUtilizado() {
        return $this->descricaoEventoServicoUtilizado;
    }

    function getDataInicioServicoUtilizado() {
        return $this->dataInicioServicoUtilizado;
    }

    function getDataFimServicoUtilizado() {
        return $this->dataFimServicoUtilizado;
    }

    function getIdServico() {
        return $this->idServico;
    }

    function getIdEvento() {
        return $this->idEvento;
    }

    function setIdEventoServicoUtilizado($idEventoServicoUtilizado) {
        $this->idEventoServicoUtilizado = $idEventoServicoUtilizado;
    }

    function setDescricaoEventoServicoUtilizado($descricaoEventoServicoUtilizado) {
        $this->descricaoEventoServicoUtilizado = $descricaoEventoServicoUtilizado;
    }

    function setDataInicioServicoUtilizado($dataInicioServicoUtilizado) {
        $this->dataInicioServicoUtilizado = $dataInicioServicoUtilizado;
    }

    function setDataFimServicoUtilizado($dataFimServicoUtilizado) {
        $this->dataFimServicoUtilizado = $dataFimServicoUtilizado;
    }

    function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    function setIdEvento($idEvento) {
        $this->idEvento = $idEvento;
    }

}
