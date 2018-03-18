<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servico
 *
 * @author anderson.alves
 */
class Servico {

    public function __construct() {
        
    }

    private $idServico;
    private $descricaoServico;

    function getIdServico() {
        return $this->idServico;
    }

    function getDescricaoServico() {
        return $this->descricaoServico;
    }

    function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    function setDescricaoServico($descricaoServico) {
        $this->descricaoServico = $descricaoServico;
    }

}
