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
        $evento->setIdEvento($row->eve_id);
        $evento->setNomeEvento($row->eve_nome);
        $evento->setDescricaoEvento($row->eve_desc);
        $evento->setSolicitanteEvento($row->eve_solicitante);
        $evento->setDataInicioEvento($row->eve_data_inicio);
        $evento->setDataFimEvento($row->eve_data_fim);
        $evento->setAmbienteIdEvento($row->amb_eve_id);
        $evento->setAmbienteDescricaoEvento($row->amb_eve_desc);
        $evento->setBlocoIdEvento($row->blo_eve_id);
        $evento->setBlocoDescricaoEvento($row->blo_eve_desc);
        $evento->setSetorIdEvento($row->set_eve_id);
        $evento->setSetorDescricaoEvento($row->set_eve_desc);
        $evento->setTipoRepeticaoIdEvento($row->eve_tip_rep_id);
        $evento->setTipoRepeticaoDescricaoEvento($row->eve_tip_rep_desc);

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

            $sql = "SELECT * from eventos eve 
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id 
                    JOIN setor_evento sev ON sev.set_eve_id = blo.blo_set_eve_id
                    JOIN evento_tipo_repeticao evt ON evt.eve_tip_rep_id = eve.eve_tip_rep_id 
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

}
