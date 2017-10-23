<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoView
 *
 * @author Anderson Alves
 */
class EventoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoView();

        return self::$instance;
    }

    public function jsonCarregarEventos($eventos) {
        print_r($eventos);
        echo json_encode($eventos);
//        $arrayEvento = array(
//            "title" => $eventos->getDescricaoEvento(),
//            "start" => $eventos->getDataInicioEvento(),
//            "end" => $eventos->getDataFimEvento()
//        );
//        echo json_encode($arrayEvento);
    }

}
