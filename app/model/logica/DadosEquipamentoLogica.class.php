<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DadosEquipamentoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class DadosEquipamentoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new DadosEquipamentoLogica();

        return self::$instance;
    }

    public function getDadosEquipamentosByIdEvento() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idEquipamento = $_REQUEST['idEquipamento'];

        return DadosEquipamentoView::getInstance()->htmlMailToResponsavelEquipamento(DadosEquipamentoDao::getInstance()->getDadosEquipamentosByIdEvento($valorIdEvento, $idEquipamento));
    }

}
