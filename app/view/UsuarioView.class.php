<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioView
 *
 * @author andersonalves
 */
class UsuarioView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new UsuarioView();
        }
        return self::$instance;
    }

    public function jsonInformationsUser($usuario) {
        $array = array();

        if (!empty($usuario)) {
            $array = [
                "idUsuario" => $usuario->getID(),
                "tipoID" => $usuario->getTipoID()
            ];
        }
        echo json_encode($array);
    }

}
