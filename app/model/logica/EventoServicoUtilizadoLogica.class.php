<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoEquipamentoUtilizadoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class EventoServicoUtilizadoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoServicoUtilizadoLogica();

        return self::$instance;
    }

    public function getInformationsServices() {
        $idEvento = $_REQUEST['idEvento'];

        return EventoServicoUtilizadoView::getInstance()->htmlInformationServices(EventoServicoUtilizadoDao::getInstance()->getInformationsServices($idEvento));
    }

    public function getServicosByIdEvento() {
        $idEvento = $_REQUEST['idEvento'];
        return EventoServicoUtilizadoView::getInstance()->tableServicosByEventId(EventoServicoUtilizadoDao::getInstance()->getInformationsServices($idEvento));
    }

}
