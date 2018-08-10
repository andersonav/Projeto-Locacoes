<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AmbienteLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class AmbienteLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new AmbienteLogica();

        return self::$instance;
    }

    public function getAmbienteByBloco() {
        $valorBloco = $_REQUEST['valorBloco'];

        return AmbienteView::getInstance()->htmlSelectAmbiente(AmbienteDao::getInstance()->getAmbienteByBloco($valorBloco));
    }

    public function getAmbiente() {
        return AmbienteView::getInstance()->htmlAmbiente(AmbienteDao::getInstance()->getAmbiente());
    }

}
