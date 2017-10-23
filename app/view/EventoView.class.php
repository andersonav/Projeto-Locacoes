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
//        $arrayEvento = array();
//        foreach ($eventos as $evento) {
//            $arrayEvento = array(
//                "title" => $evento->eve_desc,
//                "start" => $evento->eve_data_inicio,
//                "end" => $evento->eve_data_fim
//            );
//        }

        echo json_encode($arrayEvento);

//        echo json_encode($eventos);
    }

}
