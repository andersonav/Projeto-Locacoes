<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aula
 *
 * @author anderson.alves
 */
class Aula {

    public function __construct() {
        
    }

    private $idAula;
    private $descricaoAula;

    function getIdAula() {
        return $this->idAula;
    }

    function getDescricaoAula() {
        return $this->descricaoAula;
    }

    function setIdAula($idAula) {
        $this->idAula = $idAula;
    }

    function setDescricaoAula($descricaoAula) {
        $this->descricaoAula = $descricaoAula;
    }

}
