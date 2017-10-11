<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bloco
 *
 * @author anderson.alves
 */
class Bloco {

    public function __construct() {
        
    }

    private $idBloco;
    private $idSetor;
    private $descricao;

    function getIdBloco() {
        return $this->idBloco;
    }

    function getIdSetor() {
        return $this->idSetor;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdBloco($idBloco) {
        $this->idBloco = $idBloco;
    }

    function setIdSetor($idSetor) {
        $this->idSetor = $idSetor;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
