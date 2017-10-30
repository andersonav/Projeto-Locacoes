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
class TipoRepeticao {

    public function __construct() {
        
    }

    private $idTipoRepeticao;
    private $descricaoTipoRepeticao;

    function getIdTipoRepeticao() {
        return $this->idTipoRepeticao;
    }

    function getDescricaoTipoRepeticao() {
        return $this->descricaoTipoRepeticao;
    }

    function setIdTipoRepeticao($idTipoRepeticao) {
        $this->idTipoRepeticao = $idTipoRepeticao;
    }

    function setDescricaoTipoRepeticao($descricaoTipoRepeticao) {
        $this->descricaoTipoRepeticao = $descricaoTipoRepeticao;
    }

}
