<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Semestre
 *
 * @author anderson.alves
 */
class Semestre {

    public function __construct() {
        
    }

    public $idSemestre;
    public $nomeSemestre;
    public $dataInicioSemestre;
    public $dataFimSemestre;
    public $atualIdSemestre;

    function getIdSemestre() {
        return $this->idSemestre;
    }

    function getNomeSemestre() {
        return $this->nomeSemestre;
    }

    function getDataInicioSemestre() {
        return $this->dataInicioSemestre;
    }

    function getDataFimSemestre() {
        return $this->dataFimSemestre;
    }

    function getAtualIdSemestre() {
        return $this->atualIdSemestre;
    }

    function setIdSemestre($idSemestre) {
        $this->idSemestre = $idSemestre;
    }

    function setNomeSemestre($nomeSemestre) {
        $this->nomeSemestre = $nomeSemestre;
    }

    function setDataInicioSemestre($dataInicioSemestre) {
        $this->dataInicioSemestre = $dataInicioSemestre;
    }

    function setDataFimSemestre($dataFimSemestre) {
        $this->dataFimSemestre = $dataFimSemestre;
    }

    function setAtualIdSemestre($atualIdSemestre) {
        $this->atualIdSemestre = $atualIdSemestre;
    }

}
