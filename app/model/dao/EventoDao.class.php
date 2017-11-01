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

        return $evento;
    }

    public function getListObjEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEvento($row);
        }
        return $arr;
    }

    public function getEventoByAmbiente($idAmbiente, $idBloco, $idSetor) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_aula_id 
                    WHERE eve.eve_amb_id = ? AND blo.blo_eve_id = ? AND sev.set_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idAmbiente);
            $p_sql->bindParam(2, $idBloco);
            $p_sql->bindParam(3, $idSetor);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertEventoSelecionado($nomeEvento, $descricaoEvento, $solicitanteEvento, $dataInicioEvento, $dataFimEvento, $ambienteEvento, $eventoTipoRepeticao, $idAula) {

        try {

            $sql = "INSERT INTO eventos (eve_nome, eve_desc, eve_solicitante, eve_data_inicio, eve_data_fim, eve_tip_rep_id, eve_aula_id, eve_amb_id)"
                    . "VALUES (?,?,?,?,?,?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $descricaoEvento);
            $p_sql->bindParam(3, $solicitanteEvento);
            $p_sql->bindParam(4, $dataInicioEvento);
            $p_sql->bindParam(5, $dataFimEvento);
            $p_sql->bindParam(6, $eventoTipoRepeticao);
            $p_sql->bindParam(7, $idAula);
            $p_sql->bindParam(8, $ambienteEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventByAmbienteAndStartAndEnd($ambienteEvento, $start, $end) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_aula_id 
                    WHERE eve.eve_amb_id = ? AND eve.eve_data_inicio = ? AND eve.eve_data_fim = ?";
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
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_aula_id 
                    WHERE eve.eve_id = ? ";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function verifyDates($dataInicio, $dataFim, $ambienteEvento) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc,
                    eva.eve_aula_id, eva.eve_aula_desc, evad.eve_aula_det_id, evad.eve_aula_det_pro
                    FROM eventos eve
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN evento_aula eva ON eva.eve_aula_id = eve.eve_aula_id
                    LEFT JOIN evento_aula_detalhes evad ON evad.eve_aula_det_fkeve_id = eve.eve_aula_id 
                    WHERE (DATE_FORMAT(eve_data_inicio, '%H:%i') <= (DATE_FORMAT(?, '%H:%i'))
                    AND DATE_FORMAT(eve_data_inicio, '%H:%i') >= (DATE_FORMAT(?, '%H:%i')))
                    OR (DATE_FORMAT(eve_data_fim, '%H:%i') <= (DATE_FORMAT(?, '%H:%i'))
                    AND DATE_FORMAT(eve_data_fim, '%H:%i') >= (DATE_FORMAT(?, '%H:%i')))
                    AND DATE(eve_data_inicio) >= DATE(?) AND DATE(eve_data_fim) <= DATE(?)
                    AND eve.eve_amb_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $dataFim);
            $p_sql->bindParam(2, $dataInicio);
            $p_sql->bindParam(3, $dataFim);
            $p_sql->bindParam(4, $dataInicio);
            $p_sql->bindParam(5, $dataInicio);
            $p_sql->bindParam(6, $dataFim);
            $p_sql->bindParam(7, $ambienteEvento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateEventById($idEvento, $nomeEvento, $solicitante, $descricaoEvento, $colorEvento, $tipoEvento, $blocoEvento, $ambienteEvento, $dataInicio, $dataFim) {
        try {
            $sql = "UPDATE eventos SET eve_nome = ?, eve_solicitante = ?, eve_desc = ?,"
                    . "eve_amb_id = ?, eve_data_inicio = ?, eve_data_fim = ? WHERE eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $solicitante);
            $p_sql->bindParam(3, $descricaoEvento);
            $p_sql->bindParam(4, $ambienteEvento);
            $p_sql->bindParam(5, $dataInicio);
            $p_sql->bindParam(6, $dataFim);
            $p_sql->bindParam(7, $idEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function insertInTabelEventEquipamentUsed($valorIdEvento, $idEquipamento, $qtdEquipamento) {
        try {
            $sql = "INSERT INTO evento_equipamento_utilizado(eve_equi_uti_fkeve_id, eve_equi_uti_fkequi_id, eve_equi_uti_qtd)"
                    . "VALUES (?,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorIdEvento);
            $p_sql->bindParam(2, $idEquipamento);
            $p_sql->bindParam(3, $qtdEquipamento);
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

}
