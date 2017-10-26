<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorEventoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class CorEventoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new CorEventoLogica();

        return self::$instance;
    }

    public function getColorEvento() {
        return CorEventoView::getInstance()->htmlSelectColorEvento(CorEventoDao::getInstance()->getCorEvento());
    }
    
    public function getDescricaoCorEvento() {
        $corEvento = $_REQUEST['corEvento'];
        return CorEventoView::getInstance()->jsonDescricaoCorEvento(CorEventoDao::getInstance()->getDescricaoCorEvento($corEvento));
    }

}
