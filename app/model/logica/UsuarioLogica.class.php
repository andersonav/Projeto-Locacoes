<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logica
 *
 * @author anderson.alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class UsuarioLogica {

    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new UsuarioLogica();
        }

        return self::$instance;
    }

    public function login() {
        $login = $_REQUEST['login'];
        $senha = $_REQUEST['senha'];

        return UsuarioView::getInstance()->jsonInformationsUser(UsuarioDao::getInstance()->login($login, $senha));
    }

    public function logout() {

        return UsuarioDao::getInstance()->logout();
    }

    public function novaSenha(array $param) {

        return UsuarioDao::getInstance()->novaSenha($param);
    }

}
