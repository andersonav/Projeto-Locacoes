<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class DadosEquipamentoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DadosEquipamentoDao();
        }

        return self::$instance;
    }

    public function getObjEvento($row) {

        $evento = new DadosEquipamentoToMail();
        $evento->setNomeEvento($row->eve_nome);
        $evento->setDescricaoEvento($row->title);
        $evento->setSolicitanteEvento($row->eve_solicitante);
        $evento->setTelefoneSolicitante($row->eve_sol_tel);
        $evento->setEmailSolicitante($row->eve_sol_email);
        $evento->setDataInicioEvento($row->startEvento);
        $evento->setDataFimEvento($row->endEvento);
        $evento->setAmbienteIdEvento($row->amb_eve_id);
        $evento->setAmbienteDescricaoEvento($row->amb_eve_desc);
        $evento->setEquipamentoDescricaoEvento($row->equi_eve_desc);
        $evento->setEquipamentoEmailResponsavelEvento($row->equi_eve_email);
        $evento->setEquipamentoQtdUtilizadaEvento($row->eve_equi_uti_qtd);
        $evento->setEquipamentoDataInicio($row->startEquipamento);
        $evento->setEquipamentoDataFim($row->endEquipamento);

        return $evento;
    }

    public function getListObjEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEvento($row);
        }
        return $arr;
    }

    public function getDadosEquipamentosByIdEventoSendEmail($idEvento, $idEquipamento) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title, eve.eve_data_inicio as startEvento, eve.eve_data_fim as endEvento,
                    eve.eve_solicitante, eve.eve_sol_tel, eve.eve_sol_email, equ.eve_equi_uti_data_inicio as startEquipamento, equ.eve_equi_uti_data_fim as endEquipamento,
                    amb.amb_eve_id, amb.amb_eve_desc, equ.eve_equi_uti_qtd, equi.equi_eve_desc, equi.equi_eve_email  from eventos eve
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN evento_equipamento_utilizado equ ON equ.eve_equi_uti_fkeve_id = eve.eve_id
                    JOIN equipamentos_evento equi ON equi.equi_eve_id = equ.eve_equi_uti_fkequi_id
                    WHERE eve.eve_id = ? AND equi.equi_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->bindParam(2, $idEquipamento);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
