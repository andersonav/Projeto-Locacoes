<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Revisor
 *
 * @author cleonilson.ti
 */
class Usuario {

    private $id;
    private $login;
    private $nome;
    private $senha;
    private $tipoID;
    private $setorID;
    private $fornecedorID;
    private $codFornecedorMillennium;

    public function __construct($id, $login, $nome, $senha, $tipoID, $setorID, $fornecedorID, $codFornecedorMillennium) {
        $this->id = $id;
        $this->login = $login;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->tipoID = $tipoID;
        $this->setorID = $setorID;
        $this->fornecedorID = $fornecedorID;
        $this->codFornecedorMillennium = $codFornecedorMillennium;
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

        $this->login = strtoupper($login);
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

    function getSetorID() {
        return $this->setorID;
    }

    function getFornecedorID() {
        return $this->fornecedorID;
    }

    function setSetorID($setorID) {
        $this->setorID = $setorID;
    }

    function setFornecedorID($fornecedorID) {
        $this->fornecedorID = $fornecedorID;
    }

    function getCodFornecedorMillennium() {
        return $this->codFornecedorMillennium;
    }

    function setCodFornecedorMillennium($codFornecedorMillennium) {
        $this->codFornecedorMillennium = $codFornecedorMillennium;
    }

}
