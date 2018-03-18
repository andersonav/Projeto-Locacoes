<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetorLogica
 *
 * @author anderson.alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class TipoFuncionarioLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new TipoFuncionarioLogica();

        return self::$instance;
    }

    public function getTipoFuncionario() {

        return TipoFuncionarioView::getInstance()->htmlSelectTipoFuncionario(TipoFuncionarioDao::getInstance()->getTipoFuncionario());
    }
    
  
}
