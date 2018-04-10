<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquipamentoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class EquipamentoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EquipamentoLogica();

        return self::$instance;
    }

    public function getEquipamentos() {
        return EquipamentoView::getInstance()->tableEquipamentos(EquipamentoDao::getInstance()->getEquipamentos());
    }
    
    public function verifyQtdSolicitadaByIdEquipamento() {
        $idEquipamento = $_REQUEST['idEquipamento'];
        
        return EquipamentoView::getInstance()->jsonVerifyQtdSolicitadaByIdEquipamento(EquipamentoDao::getInstance()->verifyQtdDisponivelByQtdSolicitadaAndIdEquipamento($idEquipamento));
    }
    
    public function updateQtdDisponivelByIdEquipamento() {
        $idEquipamento = $_REQUEST['idEquipamento'];
        $valorAtual = $_REQUEST['valorAtual'];
        
        return EquipamentoDao::getInstance()->updateQtdDisponivelByIdEquipamento($idEquipamento, $valorAtual);
    }
    
    public function getEquipamentosNotInEvento() {
        $idEvento = $_REQUEST['idEvento'];
        return EquipamentoView::getInstance()->htmlSelectEquipamentos(EquipamentoDao::getInstance()->getEquipamentosNotInEvento($idEvento));
    }
    
}
