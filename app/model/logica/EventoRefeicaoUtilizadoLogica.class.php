<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoRefeicaoUtilizadoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class EventoRefeicaoUtilizadoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoRefeicaoUtilizadoLogica();

        return self::$instance;
    }

    public function getInformationsRefeicoes() {
        $idEvento = $_REQUEST['idEvento'];

        return EventoRefeicaoUtilizadoView::getInstance()->htmlInformationRefeicoes(EventoRefeicaoUtilizadoDao::getInstance()->getInformationsRefeicoes($idEvento));
    }
    
    public function getRefeicoesByIdEvento() {
        $idEvento = $_REQUEST['idEvento'];
        return EventoRefeicaoUtilizadoView::getInstance()->tableRefeicoesByEventId(EventoRefeicaoUtilizadoDao::getInstance()->getInformationsRefeicoes($idEvento));
    }
    
    public function getInformationsRefeicaoToEdit() {
        $idRefeicaoUtilizado = $_REQUEST['idRefeicaoUtilizado'];
        $idEvento = $_REQUEST['idEvento'];

        return EventoRefeicaoUtilizadoView::getInstance()->jsonInformationsRefeicao(EventoRefeicaoUtilizadoDao::getInstance()->getInformationsRefeicaoToEdit($idRefeicaoUtilizado, $idEvento));
    }
    
    public function deleteInTableRefeicaoUtilizado() {
        $idRefeicaoUtilizadoOfTable = $_REQUEST['idRefeicaoUtilizadoOfTable'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoRefeicaoUtilizadoDao::getInstance()->deleteInTableRefeicaoUtilizado($idRefeicaoUtilizadoOfTable, $dataInicio, $dataFim);
    }


}
