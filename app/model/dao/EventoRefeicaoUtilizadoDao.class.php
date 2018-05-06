<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EventoRefeicaoUtilizadoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EventoRefeicaoUtilizadoDao();
        }

        return self::$instance;
    }

    public function getObjEventoRefeicaoUtilizado($row) {

        $refeicao = new EventoRefeicaoUtilizado();
        $refeicao->setIdEventoRefeicaoUtilizado($row->eve_ref_uti_id);
        $refeicao->setDescricaoEventoRefeicaoUtilizado($row->ref_eve_desc);
        $refeicao->setQtdEventoRefeicaoUtilizado($row->eve_ref_uti_qtd);
        $refeicao->setDataInicioRefeicaoUtilizado($row->eve_ref_uti_data_inicio);
        $refeicao->setDataFimRefeicaoUtilizado($row->eve_ref_uti_data_fim);
        $refeicao->setIdEvento($row->eve_ref_uti_fkeve_id);
        $refeicao->setIdRefeicao($row->eve_ref_uti_fkref_id);

        return $refeicao;
    }

    public function getListObjEventoRefeicaoUtilizado($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEventoRefeicaoUtilizado($row);
        }
        return $arr;
    }

    public function getInformationsRefeicoes($idEvento) {
        try {
            $sql = "SELECT * from evento_refeicao_utilizado
                    JOIN refeicoes_evento ref ON ref.ref_eve_id = eve_ref_uti_fkref_id
                    WHERE eve_ref_uti_fkeve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoRefeicaoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getInformationsRefeicaoToEdit($idRefeicaoUtilizado, $idEvento) {
        try {
            $sql = "SELECT * FROM evento_refeicao_utilizado
                    INNER JOIN refeicoes_evento ON ref_eve_id = eve_ref_uti_fkref_id
                    WHERE eve_ref_uti_id = ? AND eve_ref_uti_fkeve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idRefeicaoUtilizado);
            $p_sql->bindParam(2, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoRefeicaoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateRefeicaoByIdEventoUtilizado($idTableEventoUtilizado, $qtdPessoasRefeicao, $dataInicio, $dataFim) {
        try {
            $sql = "UPDATE evento_refeicao_utilizado SET eve_ref_uti_qtd = ?, eve_ref_uti_data_inicio = ?, eve_ref_uti_data_fim = ? WHERE eve_ref_uti_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $qtdPessoasRefeicao);
            $p_sql->bindParam(2, $dataInicio);
            $p_sql->bindParam(3, $dataFim);
            $p_sql->bindParam(4, $idTableEventoUtilizado);
            return $p_sql->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function deleteInTableRefeicaoUtilizado($idRefeicaoUtilizadoOfTable, $dataInicio, $dataFim) {
        try {

            $sql = "UPDATE evento_refeicao_utilizado SET eve_ref_uti_fkref_id = ?, eve_ref_uti_data_inicio = ?, eve_ref_uti_data_fim = ? WHERE eve_ref_uti_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $idEvento = 0;
            $p_sql->bindParam(1, $idEvento);
            $p_sql->bindParam(2, $dataInicio);
            $p_sql->bindParam(3, $dataFim);
            $p_sql->bindParam(4, $idRefeicaoUtilizadoOfTable);
            return $p_sql->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
