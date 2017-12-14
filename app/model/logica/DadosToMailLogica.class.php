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

class DadosToMailLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new DadosToMailLogica();

        return self::$instance;
    }

    public function getDadosEquipamentosByIdEventoSendEmail() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idEquipamento = $_REQUEST['idEquipamento'];

        return DadosEquipamentoView::getInstance()->htmlMailToResponsavelEquipamento(DadosEquipamentoDao::getInstance()->getDadosEquipamentosByIdEventoSendEmail($valorIdEvento, $idEquipamento));
    }

    public function getDadosServicesByIdEventoSendEmail() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idServico = $_REQUEST['idServico'];

        return DadosServicoView::getInstance()->htmlMailToResponsavelServico(DadosServicoDao::getInstance()->getDadosServicesByIdEventoSendEmail($valorIdEvento, $idServico));
    }

    public function getDadosRefeicoesByIdEventoSendEmail() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idRefeicao = $_REQUEST['idRefeicao'];

        return DadosRefeicaoView::getInstance()->htmlMailToResponsavelServico(DadosRefeicaoDao::getInstance()->getDadosRefeicoesByIdEventoSendEmail($valorIdEvento, $idRefeicao));
    }

}
