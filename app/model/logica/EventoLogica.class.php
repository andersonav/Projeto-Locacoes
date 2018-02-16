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

    public function getEventoByPesquisa() {
        $valorDigitado = $_REQUEST['valorDigitado'];

        return EventoView::getInstance()->jsonEventos(EventoDao::getInstance()->getEventoByPesquisa($valorDigitado));
    }

    public function insertEventoSelecionado() {
        $idUsuario = $_REQUEST['idUsuario'];
        $nomeEvento = $_REQUEST['nomeEvento'];
        $descricaoEvento = $_REQUEST['descricaoEvento'];
        $solicitanteEvento = $_REQUEST['solicitanteEvento'];
        $telefoneSolicitante = $_REQUEST['telefoneSolicitante'];
        $emailSolicitante = $_REQUEST['emailSolicitante'];
        $dataInicioEvento = $_REQUEST['dataInicioEvento'];
        $dataFimEvento = $_REQUEST['dataFimEvento'];
        $ambienteEvento = $_REQUEST['ambienteEvento'];
        $eventoTipoRepeticao = $_REQUEST['eventoTipoRepeticao'];
        $idAula = $_REQUEST['idAula'];
        $eventoComeco = $dataInicioEvento;
        $eventoFinal = $dataFimEvento;
        $horarioFinal = date_format(date_create($dataFimEvento), "H:i");
        while (date_format(date_create($dataInicioEvento), "Y-m-d H:i") <= date_format(date_create($dataFimEvento), "Y-m-d H:i")) {
            $dataFimEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioFinal;
            EventoDao::getInstance()->insertEventoSelecionado($idUsuario, $nomeEvento, $descricaoEvento, $solicitanteEvento, $telefoneSolicitante, $emailSolicitante, $dataInicioEvento, $dataFimEventoDiario, $eventoComeco, $eventoFinal, $ambienteEvento, $eventoTipoRepeticao, $idAula);
            $dataInicioEvento = date('Y-m-d H:i', strtotime("+1 days", strtotime($dataInicioEvento)));
        }
    }

    public function insertEventoSelecionadoTipoRepeticao() {
        $idUsuario = $_REQUEST['idUsuario'];
        $nomeEvento = $_REQUEST['nomeEvento'];
        $descricaoEvento = $_REQUEST['descricaoEvento'];
        $solicitanteEvento = $_REQUEST['solicitanteEvento'];
        $telefoneSolicitante = $_REQUEST['telefoneSolicitante'];
        $emailSolicitante = $_REQUEST['emailSolicitante'];
        $dataInicioEvento = $_REQUEST['dataInicioEvento'];
        $dataFimEvento = $_REQUEST['dataFimEvento'];
        $horaInicioEvento = json_decode(stripslashes($_REQUEST['horaInicioEvento']));
        $horaFimEvento = json_decode(stripslashes($_REQUEST['horaFimEvento']));
        $contador = 0;
        $ambienteEvento = $_REQUEST['ambienteEvento'];
        $eventoTipoRepeticao = $_REQUEST['eventoTipoRepeticao'];
        $idAula = $_REQUEST['idAula'];
        $eventoComeco = $dataInicioEvento;
        $eventoFinal = $dataFimEvento;

        while (date_format(date_create($dataInicioEvento), "Y-m-d H:i") <= date_format(date_create($dataFimEvento), "Y-m-d H:i")) {
            if ($contador == 7) {
                $contador = 0;
            }
            $horarioInicio = date_format(date_create($horaInicioEvento[$contador][1]), "H:i");
            $horarioFinal = date_format(date_create($horaFimEvento[$contador][2]), "H:i");
            $dataInicioEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioInicio;
            $dataFimEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioFinal;
            EventoDao::getInstance()->insertEventoSelecionado($nomeEvento, $descricaoEvento, $solicitanteEvento, $telefoneSolicitante, $emailSolicitante, $dataInicioEventoDiario, $dataFimEventoDiario, $eventoComeco, $eventoFinal, $ambienteEvento, $eventoTipoRepeticao, $idAula);
            $dataInicioEvento = date('Y-m-d H:i', strtotime("+1 days", strtotime($dataInicioEvento)));
            $contador++;
        }
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
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoDao::getInstance()->insertInTabelEventEquipamentUsed($valorIdEvento, $idEquipamento, $qtdEquipamento, $dataInicio, $dataFim);
    }

    public function insertInTabelEventServiceUsed() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idServico = $_REQUEST['idServico'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoDao::getInstance()->insertInTabelEventServiceUsed($valorIdEvento, $idServico, $dataInicio, $dataFim);
    }

    public function insertInTabelEventRefeicaoUsed() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idRefeicao = $_REQUEST['idRefeicao'];
        $qtdRefeicao = $_REQUEST['qtdRefeicao'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];

        return EventoDao::getInstance()->insertInTabelEventRefeicaoUsed($valorIdEvento, $idRefeicao, $qtdRefeicao, $dataInicio, $dataFim);
    }

    public function insertIntoTableAulaDetalhes() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];
        $idAula = $_REQUEST['idAula'];
        $nomeProfessor = $_REQUEST['nomeProfessor'];

        return EventoDao::getInstance()->insertIntoTableAulaDetalhes($valorIdEvento, $idAula, $nomeProfessor);
    }

}
