<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SemestreView
 *
 * @author Anderson Alves
 */
class SemestreView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new SemestreView();

        return self::$instance;
    }

    public function jsonCarregarSemestre($semestre) {
        $array = array();
        foreach ($semestre as $half) {
            $array = [
                "dataInicioSemestre" => date_format(date_create($half->getDataInicioSemestre()), "d/m/Y"),
                "dataFimSemestre" => date_format(date_create($half->getDataFimSemestre()), "d/m/Y")
            ];
        }
        echo json_encode($array);
    }

}
