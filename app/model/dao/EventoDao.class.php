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
        $evento->setColorIdEvento($row->col_eve_id);
        $evento->setColorDescricaoEvento($row->color);

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
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc, col.col_eve_id, col.col_eve_desc_ingles as color from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN color_eventos col ON col.col_eve_id = eve.eve_col_id
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

    public function insertEventoSelecionado($nomeEvento, $descricaoEvento, $solicitanteEvento, $dataInicioEvento, $dataFimEvento, $ambienteEvento, $corEvento) {

        try {

            $sql = "INSERT INTO eventos (eve_nome, eve_desc, eve_solicitante, eve_data_inicio, eve_data_fim, eve_tip_rep_id, eve_amb_id, eve_col_id)"
                    . "VALUES (?,?,?,?,?,1,?,?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $descricaoEvento);
            $p_sql->bindParam(3, $solicitanteEvento);
            $p_sql->bindParam(4, $dataInicioEvento);
            $p_sql->bindParam(5, $dataFimEvento);
            $p_sql->bindParam(6, $ambienteEvento);
            $p_sql->bindParam(7, $corEvento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getEventById($idEvento) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc, col.col_eve_id, col.col_eve_desc_ingles as color from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN color_eventos col ON col.col_eve_id = eve.eve_col_id
                    WHERE eve.eve_id = ? ";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    public function verifyDates($dataInicio, $dataFim, $ambienteEvento) {

        try {

            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title,
                    eve.eve_solicitante, eve.eve_data_inicio as start, eve.eve_data_fim as end,
                    amb.amb_eve_id, amb.amb_eve_desc, blo.blo_eve_id, blo.blo_eve_desc, sev.set_eve_id,
                    sev.set_eve_desc, evt.eve_tip_rep_id, evt.eve_tip_rep_desc, col.col_eve_id, col.col_eve_desc_ingles as color from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
                    JOIN color_eventos col ON col.col_eve_id = eve.eve_col_id
                    WHERE eve.eve_data_inicio AND eve.eve_data_fim BETWEEN ? AND ?
                    AND eve.eve_amb_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $dataInicio);
            $p_sql->bindParam(2, $dataFim);
            $p_sql->bindParam(3, $ambienteEvento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateEventById($idEvento, $nomeEvento, $solicitante, $descricaoEvento, $colorEvento, $tipoEvento, $blocoEvento, $ambienteEvento, $dataInicio, $dataFim) {
        try {
            $sql = "UPDATE eventos SET eve_nome = ?, eve_solicitante = ?, eve_desc = ?, eve_col_id = ?, "
                    . "eve_amb_id = ?, eve_data_inicio = ?, eve_data_fim = ? WHERE eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $nomeEvento);
            $p_sql->bindParam(2, $solicitante);
            $p_sql->bindParam(3, $descricaoEvento);
            $p_sql->bindParam(4, $colorEvento);
            $p_sql->bindParam(5, $ambienteEvento);
            $p_sql->bindParam(6, $dataInicio);
            $p_sql->bindParam(7, $dataFim);
            $p_sql->bindParam(8, $idEvento);
            return $p_sql->execute();
        } catch (Exception $ex) {
            echo $exc->getTraceAsString();
        }
    }

}
