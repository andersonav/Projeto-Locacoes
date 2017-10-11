<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ambiente
 *
 * @author anderson.alves
 */
class Ambiente {

    public function __construct() {
        
    }

    private $idAmbiente;
    private $ambienteDescricao;
    private $ambienteIdBloco;
    private $ambienteBlocoDescricao;
    private $ambienteIdSetor;
    private $ambienteSetorDescricao;

    function getIdAmbiente() {
        return $this->idAmbiente;
    }

    function getAmbienteDescricao() {
        return $this->ambienteDescricao;
    }

    function getAmbienteIdBloco() {
        return $this->ambienteIdBloco;
    }

    function getAmbienteBlocoDescricao() {
        return $this->ambienteBlocoDescricao;
    }

    function getAmbienteIdSetor() {
        return $this->ambienteIdSetor;
    }

    function getAmbienteSetorDescricao() {
        return $this->ambienteSetorDescricao;
    }

    function setIdAmbiente($idAmbiente) {
        $this->idAmbiente = $idAmbiente;
    }

    function setAmbienteDescricao($ambienteDescricao) {
        $this->ambienteDescricao = $ambienteDescricao;
    }

    function setAmbienteIdBloco($ambienteIdBloco) {
        $this->ambienteIdBloco = $ambienteIdBloco;
    }

    function setAmbienteBlocoDescricao($ambienteBlocoDescricao) {
        $this->ambienteBlocoDescricao = $ambienteBlocoDescricao;
    }

    function setAmbienteIdSetor($ambienteIdSetor) {
        $this->ambienteIdSetor = $ambienteIdSetor;
    }

    function setAmbienteSetorDescricao($ambienteSetorDescricao) {
        $this->ambienteSetorDescricao = $ambienteSetorDescricao;
    }

}
