<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equipamento
 *
 * @author anderson.alves
 */
class Equipamento {

    public function __construct() {
        
    }

    private $idEquipamento;
    private $descricaoEquipamento;
    private $quantidadeEquipamento;

    function getIdEquipamento() {
        return $this->idEquipamento;
    }

    function getDescricaoEquipamento() {
        return $this->descricaoEquipamento;
    }

    function getQuantidadeEquipamento() {
        return $this->quantidadeEquipamento;
    }

    function setIdEquipamento($idEquipamento) {
        $this->idEquipamento = $idEquipamento;
    }

    function setDescricaoEquipamento($descricaoEquipamento) {
        $this->descricaoEquipamento = $descricaoEquipamento;
    }

    function setQuantidadeEquipamento($quantidadeEquipamento) {
        $this->quantidadeEquipamento = $quantidadeEquipamento;
    }

}
