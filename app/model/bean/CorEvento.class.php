<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorEvento
 *
 * @author anderson.alves
 */
class CorEvento {

    public function __construct() {
        
    }

    private $idColorEvento;
    private $descricaoColorEvento;
    private $descricaoInglesColorEvento;

    function getIdColorEvento() {
        return $this->idColorEvento;
    }

    function getDescricaoColorEvento() {
        return $this->descricaoColorEvento;
    }

    function getDescricaoInglesColorEvento() {
        return $this->descricaoInglesColorEvento;
    }

    function setIdColorEvento($idColorEvento) {
        $this->idColorEvento = $idColorEvento;
    }

    function setDescricaoColorEvento($descricaoColorEvento) {
        $this->descricaoColorEvento = $descricaoColorEvento;
    }

    function setDescricaoInglesColorEvento($descricaoInglesColorEvento) {
        $this->descricaoInglesColorEvento = $descricaoInglesColorEvento;
    }

}
