<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EventoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EventoDao();
        }

        return self::$instance;
    }

    public function getObjEvento($row) {

        $evento = new Evento();
        $evento->setIdEvento($row->id);
        $evento->setNomeEvento($row->eve_nome);
        $evento->setDescricaoEvento($row->title);
        $evento->setTelefoneSolicitante($row->eve_sol_tel);
        $evento->setEmailSolicitante($row->eve_sol_email);
        $evento->setSolicitanteEvento($row->eve_solicitante);
        $evento->setDataInicioEvento($row->start);
        $evento->setDataFimEvento($row->end);
        $evento->setAmbienteIdEvento($row->amb_eve_id);
        $evento->setAmbienteDescricaoEvento($row->amb_eve_desc);
        $evento->setBlocoIdEvento($row->blo_eve_id);
        $evento->setBlocoDescricaoEvento($row->blo_eve_desc);
        $evento->setSetorIdEvento($row->set_eve_id);
        $evento->setSetorDescricaoEvento($row->set_eve_desc);
        $evento->setTipoRepeticaoIdEvento($row->eve_tip_rep_id);
        $evento->setTipoRepeticaoDescricaoEvento($row->eve_tip_rep_desc);
        $evento->setAulaIdEvento($row->eve_aula_id);
        $evento->setAulaDescricaoEvento($row->eve_aula_desc);
        $evento->setNomeProfessorEvento($row->eve_aula_det_pro);
        $evento->setDiaSemanaDescricao(utf8_decode($row->dia_sem_nome));
        $evento->setEventoRandom($row->eve_random);
        $evento->setIdFiltroEvento($row->eve_fkfiltro_evento);

        return $evento;
    }

    public function getListObjEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEvento($row);
        }
        return $arr;
    }

    public function getEventoByAmbiente($idAmbiente, $idBloco, $idSetor, $idSituacao, $idTipoSolicitacao) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, diaSem.dia_sem_nome, evad.eve_aula_det_id, evad.eve_aula_det_pro from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id
                    WHERE eve.eve_amb_id = ? AND blo.blo_eve_id = ? AND sev.set_eve_id = ? AND eve.eve_fksituacao_evento = ? AND eve.eve_fkfiltro_evento = ? AND date(eve.eve_data_inicio) = date(eve.eve_data_fim) AND eve.eve_ativo = 1;";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idAmbiente);
            $p_sql->bindParam(2, $idBloco);
            $p_sql->bindParam(3, $idSetor);
            $p_sql->bindParam(4, $idSituacao);
            $p_sql->bindParam(5, $idTipoSolicitacao);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventoByDatesAndAmbiente($idAmbiente, $idBloco, $idSetor, $dataInicio, $dataFim) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro, diaSem.dia_sem_nome from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id 
                    WHERE eve.eve_amb_id = ? AND blo.blo_eve_id = ? AND sev.set_eve_id = ? AND date(eve.eve_data_inicio) = date(eve.eve_data_fim) AND eve.eve_data_inicio >= ? AND eve.eve_data_fim <= ? AND eve.eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idAmbiente);
            $p_sql->bindParam(2, $idBloco);
            $p_sql->bindParam(3, $idSetor);
            $p_sql->bindParam(4, $dataInicio);
            $p_sql->bindParam(5, $dataFim);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertEventoSelecionado($idUsuario, $nomeEvento, $descricaoEvento, $solicitanteEvento, $telefoneSolicitante, $emailSolicitante, $filtroEvento, $dataInicioEvento, $dataFimEvento, $eventoComeco, $eventoFim, $ambienteEvento, $eventoTipoRepeticao, $idAula, $diaNumero, $random) {

        try {
            $logicaAula = 1;
            $ativo = 1;
            $sql = "INSERT INTO eventos (eve_nome, eve_desc, eve_solicitante, eve_sol_tel, eve_sol_email, eve_data_inicio, eve_data_fim, eve_comeco, eve_fim, eve_tip_rep_id, eve_aula_id, eve_amb_id, eve_usu_id, eve_fkdia_codigo, eve_logica, eve_random, eve_ativo, eve_fkfiltro_evento, eve_fksituacao_evento)"
                    . "VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $descricaoEvento);
            $p_sql->bindParam(3, $solicitanteEvento);
            $p_sql->bindParam(4, $telefoneSolicitante);
            $p_sql->bindParam(5, $emailSolicitante);
            $p_sql->bindParam(6, $dataInicioEvento);
            $p_sql->bindParam(7, $dataFimEvento);
            $p_sql->bindParam(8, $eventoComeco);
            $p_sql->bindParam(9, $eventoFim);
            $p_sql->bindParam(10, $eventoTipoRepeticao);
            $p_sql->bindParam(11, $idAula);
            $p_sql->bindParam(12, $ambienteEvento);
            $p_sql->bindParam(13, $idUsuario);
            $p_sql->bindParam(14, $diaNumero);
            $p_sql->bindParam(15, $logicaAula);
            $p_sql->bindParam(16, $random);
            $p_sql->bindParam(17, $ativo);
            $p_sql->bindParam(18, $filtroEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventByAmbienteAndStartAndEnd($ambienteEvento, $start, $end) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro, diaSem.dia_sem_nome from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id 
                    WHERE eve.eve_amb_id = ? AND eve.eve_comeco = ? AND eve.eve_fim = ? AND eve.eve_logica = 1 AND eve.eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $ambienteEvento);
            $p_sql->bindParam(2, $start);
            $p_sql->bindParam(3, $end);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventById($idEvento) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro, diaSem.dia_sem_nome from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id
                    WHERE eve.eve_id = ? AND eve.eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventoByPesquisa($valorDigitado) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro, diaSem.dia_sem_nome from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id
                    WHERE eve.eve_nome LIKE '%" . $valorDigitado . "%' OR eve.eve_desc LIKE '%" . $valorDigitado . "%'
                    OR eve.eve_solicitante LIKE '%" . $valorDigitado . "%'
                    OR amb.amb_eve_desc LIKE '%" . $valorDigitado . "%'
                    OR blo.blo_eve_desc LIKE '%" . $valorDigitado . "%' AND eve.eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function verifyDates($dataInicio, $dataFim, $ambienteEvento, $diaNumero) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_sol_tel, eve.eve_sol_email, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end, eve.eve_random, eve.eve_ativo, eve.eve_fkfiltro_evento,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro, diaSem.dia_sem_nome
                    FROM eventos eve
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    JOIN dias_semana diaSem ON diaSem.dia_sem_codigo = eve.eve_fkdia_codigo
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_id
                    WHERE DATE(eve_data_inicio) >= DATE(?) 
                    AND DATE(eve_data_fim) <= DATE(?)
                    AND ((DATE_FORMAT(eve_data_inicio, '%H:%i') >= DATE_FORMAT(?, '%H:%i')
                    AND DATE_FORMAT(eve_data_fim, '%H:%i') <= DATE_FORMAT(?, '%H:%i'))
                    OR 
                    (DATE_FORMAT(eve_data_inicio, '%H:%i') < DATE_FORMAT(?, '%H:%i')
                    AND DATE_FORMAT(eve_data_fim, '%H:%i') > DATE_FORMAT(?, '%H:%i'))
                    OR
                    (DATE_FORMAT(eve_data_inicio, '%H:%i') < DATE_FORMAT(?, '%H:%i')
                    AND DATE_FORMAT(eve_data_fim, '%H:%i') > DATE_FORMAT(?, '%H:%i'))
                    OR
                    (DATE_FORMAT(eve_data_inicio, '%H:%i') <= DATE_FORMAT(?, '%H:%i')
                    AND DATE_FORMAT(eve_data_fim, '%H:%i') >= DATE_FORMAT(?, '%H:%i'))
                    OR 
                    (DATE_FORMAT(eve_data_fim, '%H:%i') > DATE_FORMAT(?, '%H:%i')
                    AND DATE_FORMAT(eve_data_inicio, '%H:%i') <= DATE_FORMAT(?, '%H:%i')))
                    AND eve.eve_amb_id = ? AND eve.eve_fkdia_codigo = ? AND eve.eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $dataInicio);
            $p_sql->bindParam(2, $dataFim);
            $p_sql->bindParam(3, $dataInicio);
            $p_sql->bindParam(4, $dataFim);
            $p_sql->bindParam(5, $dataInicio);
            $p_sql->bindParam(6, $dataFim);
            $p_sql->bindParam(7, $dataFim);
            $p_sql->bindParam(8, $dataFim);
            $p_sql->bindParam(9, $dataInicio);
            $p_sql->bindParam(10, $dataFim);
            $p_sql->bindParam(11, $dataInicio);
            $p_sql->bindParam(12, $dataInicio);
            $p_sql->bindParam(13, $ambienteEvento);
            $p_sql->bindParam(14, $diaNumero);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateEventById($idEvento, $nomeEvento, $solicitante, $telefoneSolicitante, $emailSolicitante, $descricaoEvento, $tipoEvento, $blocoEvento, $ambienteEvento, $dataInicio, $dataFim, $filtroEvento) {
        try {
            $sql = "UPDATE eventos SET eve_nome = ?, eve_solicitante = ?, eve_desc = ?,
                    eve_amb_id = ?, eve_data_inicio = ?, eve_data_fim = ?, eve_sol_tel = ?, eve_sol_email = ?, eve_fkfiltro_evento = ? WHERE eve_id = ? AND eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $solicitante);
            $p_sql->bindParam(3, $descricaoEvento);
            $p_sql->bindParam(4, $ambienteEvento);
            $p_sql->bindParam(5, $dataInicio);
            $p_sql->bindParam(6, $dataFim);
            $p_sql->bindParam(7, $telefoneSolicitante);
            $p_sql->bindParam(8, $emailSolicitante);
            $p_sql->bindParam(9, $filtroEvento);
            $p_sql->bindParam(10, $idEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function deleteEventoByRandom($numeroRandom) {
        try {
            $sql = "UPDATE eventos SET eve_ativo = 2 WHERE eve_random = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $numeroRandom);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertInTabelEventEquipamentUsed($valorIdEvento, $idEquipamento, $qtdEquipamento, $dataInicio, $dataFim) {
        try {
            $sql = "INSERT INTO evento_equipamento_utilizado(eve_equi_uti_fkeve_id, eve_equi_uti_fkequi_id, eve_equi_uti_qtd, eve_equi_uti_data_inicio, eve_equi_uti_data_fim)"
                    . "VALUES (?,?,?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorIdEvento);
            $p_sql->bindParam(2, $idEquipamento);
            $p_sql->bindParam(3, $qtdEquipamento);
            $p_sql->bindParam(4, $dataInicio);
            $p_sql->bindParam(5, $dataFim);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertInTabelEventServiceUsed($valorIdEvento, $idServico, $dataInicio, $dataFim) {
        try {
            $sql = "INSERT INTO evento_servico_utilizado(eve_ser_uti_fkeve_id, eve_ser_uti_fkser_id, eve_ser_uti_data_inicio, eve_ser_uti_data_fim)"
                    . "VALUES (?,?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorIdEvento);
            $p_sql->bindParam(2, $idServico);
            $p_sql->bindParam(3, $dataInicio);
            $p_sql->bindParam(4, $dataFim);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertInTabelEventRefeicaoUsed($valorIdEvento, $idRefeicao, $qtdRefeicao, $dataInicio, $dataFim) {
        try {
            $sql = "INSERT INTO evento_refeicao_utilizado(eve_ref_uti_fkeve_id, eve_ref_uti_fkref_id, eve_ref_uti_qtd, eve_ref_uti_data_inicio, eve_ref_uti_data_fim)"
                    . "VALUES (?,?,?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorIdEvento);
            $p_sql->bindParam(2, $idRefeicao);
            $p_sql->bindParam(3, $qtdRefeicao);
            $p_sql->bindParam(4, $dataInicio);
            $p_sql->bindParam(5, $dataFim);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertIntoTableAulaDetalhes($valorIdEvento, $idAula, $nomeProfessor) {
        try {
            $sql = "INSERT INTO evento_aula_detalhes(eve_aula_det_fkeve_id, eve_aula_det_fkaula_id, eve_aula_det_pro)"
                    . "VALUES (?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorIdEvento);
            $p_sql->bindParam(2, $idAula);
            $p_sql->bindParam(3, $nomeProfessor);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateEveLogicaToZero($idEvento) {
        try {
            $sql = "UPDATE eventos SET eve_logica = 0 WHERE eve_id = ? AND eve_ativo = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
