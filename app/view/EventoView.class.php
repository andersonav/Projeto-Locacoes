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
//        print_r($eventos);
        $array = array();
        foreach ($eventos as $evento) {
            $array = array(
                "id" => $evento->idEvento,
                "title" => $evento->descricaoEvento,
                "start" => $evento->dataInicioEvento,
                "end" => $evento->dataFimEvento
            );
        }
        echo json_encode($array);
    }

}
