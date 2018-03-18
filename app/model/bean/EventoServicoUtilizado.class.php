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

}
