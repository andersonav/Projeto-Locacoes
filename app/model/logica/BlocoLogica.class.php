<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlocoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class BlocoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new BlocoLogica();

        return self::$instance;
    }

    public function getBlocoBySetor() {
        $tipoEvento = $_REQUEST['valorTipoEvento'];
        return BlocoView::getInstance()->htmlSelectBloco(BlocoDao::getInstance()->getBlocoBySetor($tipoEvento));
    }

}
