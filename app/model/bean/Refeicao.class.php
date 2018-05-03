<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Refeicao
 *
 * @author anderson.alves
 */
class Refeicao {

    public function __construct() {
        
    }

    private $idRefeicao;
    private $descricaoRefeicao;

    function getIdRefeicao() {
        return $this->idRefeicao;
    }

    function getDescricaoRefeicao() {
        return $this->descricaoRefeicao;
    }

    function setIdRefeicao($idRefeicao) {
        $this->idRefeicao = $idRefeicao;
    }

    function setDescricaoRefeicao($descricaoRefeicao) {
        $this->descricaoRefeicao = $descricaoRefeicao;
    }

}
