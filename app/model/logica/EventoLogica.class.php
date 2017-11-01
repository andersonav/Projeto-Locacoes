<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EventoLogica
 *
 * @author Anderson Alves
 */
require_once '../autoload.php';
spl_autoload_register('autoloadDao');
spl_autoload_register('autoloadView');

class EventoLogica {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new EventoLogica();

        return self::$instance;
    }

    public function getEventoByAmbiente() {
        $idAmbiente = $_REQUEST['idAmbiente'];
        $idBloco = $_REQUEST['idBloco'];
        $idSetor = $_REQUEST['idSetor'];

        return EventoView::getInstance()->jsonCarregarEventos(EventoDao::getInstance()->getEventoByAmbiente($idAmbiente, $idBloco, $idSetor));
    }

    public function insertEventoSelecionado() {
        $nomeEvento = $_REQUEST['nomeEvento'];
        $descricaoEvento = $_REQUEST['descricaoEvento'];
        $solicitanteEvento = $_REQUEST['solicitanteEvento'];
        $dataInicioEvento = $_REQUEST['dataInicioEvento'];
        $dataFimEvento = $_REQUEST['dataFimEvento'];
        $ambienteEvento = $_REQUEST['ambienteEvento'];
        $eventoTipoRepeticao = $_REQUEST['eventoTipoRepeticao'];
        $idAula = $_REQUEST['idAula'];
        
        return EventoDao::getInstance()->insertEventoSelecionado($nomeEvento, $descricaoEvento, $solicitanteEvento, $dataInicioEvento, $dataFimEvento, $ambienteEvento, $eventoTipoRepeticao, $idAula);
      
    }

    public function getEventById() {
        $idEvento = $_REQUEST['idEvento'];

        return EventoView::getInstance()->htmlModalToUpdateEvent(EventoDao::getInstance()->getEventById($idEvento));
    }

    public function getEventByIdPageUser() {
        $idEvento = $_REQUEST['idEvento'];

        return EventoView::getInstance()->htmlModalToInformationEvent(EventoDao::getInstance()->getEventById($idEvento));
    }

    public function updateEventById() {
        $idEvento = $_REQUEST['idEvento'];
        $nomeEvento = $_REQUEST['nomeEvento'];
        $solicitante = $_REQUEST['solicitante'];
        $descricaoEvento = $_REQUEST['descricaoEvento'];
        $tipoEvento = $_REQUEST['tipoEvento'];
        $blocoEvento = $_REQUEST['blocoEvento'];
        $ambienteEvento = $_REQUEST['ambienteEvento'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoDao::getInstance()->updateEventById($idEvento, $nomeEvento, $solicitante, $descricaoEvento, $tipoEvento, $blocoEvento, $ambienteEvento, $dataInicio, $dataFim);
    }

    public function verifyDates() {
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];
        $ambienteEvento = $_REQUEST['ambienteEvento'];

        return EventoView::getInstance()->jsonVerifyDates(EventoDao::getInstance()->verifyDates($dataInicio, $dataFim, $ambienteEvento));
    }

    public function getEventByAmbienteAndStartAndEnd() {
        $ambienteEvento = $_REQUEST['ambienteEvento'];
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];

        return EventoView::getInstance()->jsonEventByAmbienteAndStartAndEnd(EventoDao::getInstance()->getEventByAmbienteAndStartAndEnd($ambienteEvento, $start, $end));
    }

    public function insertInTabelEventEquipamentUsed() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idEquipamento = $_REQUEST['idEquipamento'];
        $qtdEquipamento = $_REQUEST['qtdEquipamento'];

        return EventoDao::getInstance()->insertInTabelEventEquipamentUsed($valorIdEvento, $idEquipamento, $qtdEquipamento);
    }

    public function insertIntoTableAulaDetalhes() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idAula = $_REQUEST['idAula'];
        $nomeProfessor = $_REQUEST['nomeProfessor'];

        return EventoDao::getInstance()->insertIntoTableAulaDetalhes($valorIdEvento, $idAula, $nomeProfessor);
    }

}
