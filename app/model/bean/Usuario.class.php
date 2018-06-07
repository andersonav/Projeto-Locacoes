<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author anderson.alves
 */
class Usuario {

    public $id;
    public $login;
    public $nome;
    public $senha;
    public $tipoID;

    public function __construct($id, $login, $nome, $senha, $tipoID) {
        $this->id = $id;
        $this->login = $login;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->tipoID = $tipoID;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }

    public function getLogin() {

        return $this->login;
    }

    public function setLogin($login) {

        $this->login = $login;
    }

    public function getSenha() {

        return $this->senha;
    }

    public function setSenha($senha) {

        $this->senha = $senha;
    }

    function getTipoID() {
        return $this->tipoID;
    }

    function setTipoID($tipoID) {
        $this->tipoID = $tipoID;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

}
