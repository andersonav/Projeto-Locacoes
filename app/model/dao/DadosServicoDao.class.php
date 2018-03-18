<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class DadosServicoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DadosServicoDao();
        }

        return self::$instance;
    }

    public function getObjEvento($row) {

        $evento = new DadosServicoToMail();
        $evento->setNomeEvento($row->eve_nome);
        $evento->setDescricaoEvento($row->title);
        $evento->setSolicitanteEvento($row->eve_solicitante);
        $evento->setTelefoneSolicitante($row->eve_sol_tel);
        $evento->setEmailSolicitante($row->eve_sol_email);
        $evento->setDataInicioEvento($row->startEvento);
        $evento->setDataFimEvento($row->endEvento);
        $evento->setAmbienteIdEvento($row->amb_eve_id);
        $evento->setAmbienteDescricaoEvento($row->amb_eve_desc);
        $evento->setServicoDescricaoEvento($row->ser_eve_desc);
        $evento->setServicoEmailResponsavelEvento($row->ser_eve_email);
        $evento->setServicoDataInicio($row->startServico);
        $evento->setServicoDataFim($row->endServico);

        return $evento;
    }

    public function getListObjEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEvento($row);
        }
        return $arr;
    }

    public function getDadosServicesByIdEventoSendEmail($idEvento, $idServico) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title, eve.eve_data_inicio as startEvento, eve.eve_data_fim as endEvento,
                    eve.eve_solicitante, eve.eve_sol_tel, eve.eve_sol_email, serUti.eve_ser_uti_data_inicio as startServico, serUti.eve_ser_uti_data_fim as endServico,
                    amb.amb_eve_id, amb.amb_eve_desc, ser.ser_eve_desc, ser.ser_eve_email from eventos eve
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN evento_servico_utilizado serUti ON serUti.eve_ser_uti_fkeve_id = eve.eve_id
                    JOIN servicos_evento ser ON ser.ser_eve_id = serUti.eve_ser_uti_fkser_id
                    WHERE eve.eve_id = ? AND ser.ser_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->bindParam(2, $idServico);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
