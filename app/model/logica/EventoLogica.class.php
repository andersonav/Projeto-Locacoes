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
        $corEvento = $_REQUEST['corEvento'];

        $insert = EventoDao::getInstance()->insertEventoSelecionado($nomeEvento, $descricaoEvento, $solicitanteEvento, $dataInicioEvento, $dataFimEvento, $ambienteEvento, $corEvento);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

}
