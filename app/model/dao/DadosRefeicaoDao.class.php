<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class DadosRefeicaoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new DadosRefeicaoDao();
        }

        return self::$instance;
    }

    public function getObjEvento($row) {

        $evento = new DadosRefeicaoToMail();
        $evento->setNomeEvento($row->eve_nome);
        $evento->setDescricaoEvento($row->title);
        $evento->setSolicitanteEvento($row->eve_solicitante);
        $evento->setTelefoneSolicitante($row->eve_sol_tel);
        $evento->setEmailSolicitante($row->eve_sol_email);
        $evento->setDataInicioEvento($row->startEvento);
        $evento->setDataFimEvento($row->endEvento);
        $evento->setAmbienteIdEvento($row->amb_eve_id);
        $evento->setAmbienteDescricaoEvento($row->amb_eve_desc);
        $evento->setRefeicaoDescricaoEvento($row->ref_eve_desc);
        $evento->setRefeicaoEmailResponsavelEvento($row->ref_eve_email);
        $evento->setRefeicaoQtdUtilizadaEvento($row->eve_ref_uti_qtd);
        $evento->setRefeicaoDataInicio($row->startRefeicao);
        $evento->setRefeicaoDataFim($row->endRefeicao);

        return $evento;
    }

    public function getListObjEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEvento($row);
        }
        return $arr;
    }

    public function getDadosRefeicaoByIdEventoSendEmail($idEvento, $idRefeicao) {
        try {
            $sql = "SELECT eve.eve_id as id, eve.eve_nome, eve.eve_desc as title, eve.eve_data_inicio as startEvento, eve.eve_data_fim as endEvento,
                    eve.eve_solicitante, eve.eve_sol_tel, eve.eve_sol_email, refUti.eve_ref_uti_data_inicio as startRefeicao, refUti.eve_ref_uti_data_fim as endRefeicao,
                    amb.amb_eve_id, amb.amb_eve_desc, refUti.eve_ref_uti_qtd, ref.ref_eve_desc, ref.ref_eve_email from eventos eve
                    JOIN ambiente_evento amb ON amb.amb_eve_id = eve.eve_amb_id
                    JOIN evento_refeicao_utilizado refUti ON refUti.eve_ref_uti_fkeve_id = eve.eve_id
                    JOIN refeicoes_evento ref ON ref.ref_eve_id = refUti.eve_ref_uti_fkref_id
                    WHERE eve.eve_id = ? AND ref.ref_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->bindParam(2, $idRefeicao);
            $p_sql->execute();

            return $this->getListObjEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
