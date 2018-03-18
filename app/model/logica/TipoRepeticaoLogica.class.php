<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoRepeticaoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class TipoRepeticaoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new TipoRepeticaoLogica();

        return self::$instance;
    }

    public function getTipoRepeticao() {
        
        return TipoRepeticaoView::getInstance()->htmlSelectTipoRepeticao(TipoRepeticaoDao::getInstance()->getTipoRepeticao());
    }

}
