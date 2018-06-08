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

    public function getEventoByDatesAndAmbiente() {
        $idAmbiente = $_REQUEST['idAmbiente'];
        $idBloco = $_REQUEST['idBloco'];
        $idSetor = $_REQUEST['idSetor'];
        $dataInicio = $_REQUEST['dataInicio'];
        $dataFim = $_REQUEST['dataFim'];
        $dataFimAux = date('Y-m-d', strtotime("+1 days", strtotime($dataInicio)));
        return EventoView::getInstance()->jsonCarregarEventos(EventoDao::getInstance()->getEventoByDatesAndAmbiente($idAmbiente, $idBloco, $idSetor, $dataInicio, $dataFimAux));
    }

    public function getEventoByPesquisa() {
        $valorDigitado = $_REQUEST['valorDigitado'];

        return EventoView::getInstance()->jsonEventos(EventoDao::getInstance()->getEventoByPesquisa($valorDigitado));
    }

    public function insertEventoSelecionado() {
        session_start();
        if ($_SESSION['usuario_tipo_id'] == 1 || $_SESSION['usuario_tipo_id'] == 2) {
            $idUsuario = $_SESSION['usuario_id'];
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
                $dataInicioToValorDia = date_format(date_create($dataInicioEvento), 'Y-m-d');
                $diaNumero = date("w", strtotime($dataInicioToValorDia));
                $dataFimEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioFinal;
                EventoDao::getInstance()->insertEventoSelecionado($idUsuario, $nomeEvento, $descricaoEvento, $solicitanteEvento, $telefoneSolicitante, $emailSolicitante, $dataInicioEvento, $dataFimEventoDiario, $eventoComeco, $eventoFinal, $ambienteEvento, $eventoTipoRepeticao, $idAula, $diaNumero);
                $dataInicioEvento = date('Y-m-d H:i', strtotime("+1 days", strtotime($dataInicioEvento)));
            }
        } else {
            echo "Permissão negada";
        }
    }

    public function insertEventoSelecionadoTipoRepeticao() {
        session_start();
        if ($_SESSION['usuario_tipo_id'] == 1 || $_SESSION['usuario_tipo_id'] == 2) {
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
            $tamanhoArray = count($horaInicioEvento);
            $ambienteEvento = $_REQUEST['ambienteEvento'];
            $eventoTipoRepeticao = $_REQUEST['eventoTipoRepeticao'];
            $idAula = $_REQUEST['idAula'];
            $eventoComeco = $dataInicioEvento;
            $eventoFinal = $dataFimEvento;
            while (date_format(date_create($dataInicioEvento), "Y-m-d H:i") <= date_format(date_create($dataFimEvento), "Y-m-d H:i")) {
                $dataInicioToValorDia = date_format(date_create($dataInicioEvento), 'Y-m-d');
                $diaNumero = date("w", strtotime($dataInicioToValorDia));
                if ($diaNumero == 6 || $contador == $tamanhoArray) {
                    $contador = 0;
                }
                $valorDiaRecebido = $horaInicioEvento[$contador][3];
                if ($diaNumero == $valorDiaRecebido) {
                    foreach ($horaInicioEvento as $value) {
                        if ($diaNumero == $value[3]) {
                            $horarioInicio = date_format(date_create($value[1]), "H:i");
                            $horarioFinal = date_format(date_create($value[2]), "H:i");
                            $dataInicioEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioInicio;
                            $dataFimEventoDiario = date_format(date_create($dataInicioEvento), "Y-m-d") . ' ' . $horarioFinal;
                            $objeto = EventoDao::getInstance()->verifyDates($dataInicioEventoDiario, $dataFimEventoDiario, $ambienteEvento, $diaNumero);
//                        print_r($objeto);
                            if (count($objeto) > 0) {
                                $dataInicioEvento = date('Y-m-d H:i', strtotime($dataFimEvento));
                                return EventoView::getInstance()->modalErrorVerifyDates($objeto);
                            } else {
                                EventoDao::getInstance()->insertEventoSelecionado($idUsuario, $nomeEvento, $descricaoEvento, $solicitanteEvento, $telefoneSolicitante, $emailSolicitante, $dataInicioEventoDiario, $dataFimEventoDiario, $eventoComeco, $eventoFinal, $ambienteEvento, $eventoTipoRepeticao, $idAula, $diaNumero);
                                $contador++;
                            }
                        }
                    }
                }
                $dataInicioEvento = date('Y-m-d H:i', strtotime("+1 days", strtotime($dataInicioEvento)));
            }
        } else {
            echo "Permissão negada";
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
        $dataInicioToValorDia = date_format(date_create($dataInicio), 'Y-m-d');
        $diaNumero = date("w", strtotime($dataInicioToValorDia));
        return EventoView::getInstance()->jsonVerifyDates(EventoDao::getInstance()->verifyDates($dataInicio, $dataFim, $ambienteEvento, $diaNumero));
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

    public function updateEveLogicaToZero() {
        $valorIdEvento = $_REQUEST['valorIdEvento'];

        return EventoDao::getInstance()->updateEveLogicaToZero($valorIdEvento);
    }

}
