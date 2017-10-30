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
    private $qtdEventoEquipamentoUtilizado;

    function getIdEventoEquipamentoUtilizado() {
        return $this->idEventoEquipamentoUtilizado;
    }

    function getDescricaoEventoEquipamentoUtilizado() {
        return $this->descricaoEventoEquipamentoUtilizado;
    }

    function getQtdEventoEquipamentoUtilizado() {
        return $this->qtdEventoEquipamentoUtilizado;
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

}
