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

class EventoEquipamentoUtilizadoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoEquipamentoUtilizadoLogica();

        return self::$instance;
    }

    public function getInformationsEquipaments() {
        $idEvento = $_REQUEST['idEvento'];

        return EventoEquipamentoUtilizadoView::getInstance()->htmlInformationEquipaments(EventoEquipamentoUtilizadoDao::getInstance()->getInformationsEquipaments($idEvento));
    }

    public function getEquipamentosByIdEvento() {
        $idEvento = $_REQUEST['idEvento'];
        return EventoEquipamentoUtilizadoView::getInstance()->tableEquipamentosByEventId(EventoEquipamentoUtilizadoDao::getInstance()->getInformationsEquipaments($idEvento));
    }

    public function getInformationsMaterialToEdit() {
        $idMaterialUtilizado = $_REQUEST['idMaterialUtilizado'];
        $idEvento = $_REQUEST['idEvento'];

        return EventoEquipamentoUtilizadoView::getInstance()->jsonInformationsMaterial(EventoEquipamentoUtilizadoDao::getInstance()->getInformationsMaterialToEdit($idMaterialUtilizado, $idEvento));
    }

    public function updateMaterialByIdEventoUtilizado() {
        $idTableEventoUtilizado = $_REQUEST['idTableEventoUtilizado'];
        $quantidadeSolicitada = $_REQUEST['quantidadeSolicitada'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoEquipamentoUtilizadoDao::getInstance()->updateMaterialByIdEventoUtilizado($idTableEventoUtilizado, $quantidadeSolicitada, $dataInicio, $dataFim);
    }

    public function deleteInTableMaterialUtilizado() {
        $idMaterialUtilizadoOfTable = $_REQUEST['idMaterialUtilizadoOfTable'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoEquipamentoUtilizadoDao::getInstance()->deleteInTableMaterialUtilizado($idMaterialUtilizadoOfTable, $dataInicio, $dataFim);
    }

}
