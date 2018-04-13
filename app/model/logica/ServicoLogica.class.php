<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServicoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class ServicoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new ServicoLogica();

        return self::$instance;
    }

    public function getServicos() {
        return ServicoView::getInstance()->tableServicos(ServicoDao::getInstance()->getServicos());
    }

    public function verifyQtdSolicitadaByIdServico() {
        $idEquipamento = $_REQUEST['idEquipamento'];

        return ServicoView::getInstance()->jsonVerifyQtdSolicitadaByIdServico(ServicoDao::getInstance()->verifyQtdDisponivelByQtdSolicitadaAndIdServico($idEquipamento));
    }

    public function updateQtdDisponivelByIdServico() {
        $idEquipamento = $_REQUEST['idEquipamento'];
        $valorQtdisponivel = $_REQUEST['qtdDisponivelAtual'];

        return ServicoDao::getInstance()->updateQtdDisponivelByIdServico($idEquipamento, $valorQtdisponivel);
    }

    public function getServicoNotInEvento() {
        $idEvento = $_REQUEST['idEvento'];
        return ServicoView::getInstance()->htmlSelectServicos(ServicoDao::getInstance()->getServicoNotInEvento($idEvento));
    }

}
