<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EventoEquipamentoUtilizadoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EventoEquipamentoUtilizadoDao();
        }

        return self::$instance;
    }

    public function getObjEventoEquipamentoUtilizado($row) {

        $equipamento = new EventoEquipamentoUtilizado();
        $equipamento->setIdEventoEquipamentoUtilizado($row->eve_equi_uti_id);
        $equipamento->setDescricaoEventoEquipamentoUtilizado($row->equi_eve_desc);
        $equipamento->setQtdEventoEquipamentoUtilizado($row->eve_equi_uti_qtd);
        $equipamento->setDataInicioEquipamentoUtilizado($row->eve_equi_uti_data_inicio);
        $equipamento->setDataFimEquipamentoUtilizado($row->eve_equi_uti_data_fim);
        $equipamento->setQtdDisponivelEquipamento($row->equi_eve_qtd);
        $equipamento->setIdEquipamento($row->equi_eve_id);
        $equipamento->setIdEvento($row->eve_equi_uti_fkeve_id);

        return $equipamento;
    }

    public function getListObjEventoEquipamentoUtilizado($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEventoEquipamentoUtilizado($row);
        }
        return $arr;
    }

    public function getInformationsEquipaments($idEvento) {
        try {
            $sql = "SELECT * from  equipamentos_evento equi
                    LEFT JOIN evento_equipamento_utilizado ON equi.equi_eve_id = eve_equi_uti_fkequi_id
                    WHERE eve_equi_uti_fkeve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoEquipamentoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getInformationsMaterialToEdit($idMaterialUtilizado, $idEvento) {
        try {
            $sql = "SELECT * FROM evento_equipamento_utilizado
                    INNER JOIN equipamentos_evento ON equi_eve_id = eve_equi_uti_fkequi_id
                    WHERE eve_equi_uti_id = ? AND eve_equi_uti_fkeve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idMaterialUtilizado);
            $p_sql->bindParam(2, $idEvento);
            $p_sql->execute();

            return $this->getListObjEventoEquipamentoUtilizado($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateMaterialByIdEventoUtilizado($idTableEventoUtilizado, $quantidadeSolicitada, $dataInicio, $dataFim) {
        try {
            $sql = "UPDATE evento_equipamento_utilizado SET eve_equi_uti_qtd = ?, eve_equi_uti_data_inicio = ?, eve_equi_uti_data_fim = ? WHERE eve_equi_uti_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $quantidadeSolicitada);
            $p_sql->bindParam(2, $dataInicio);
            $p_sql->bindParam(3, $dataFim);
            $p_sql->bindParam(4, $idTableEventoUtilizado);
            return $p_sql->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function deleteInTableMaterialUtilizado($idMaterialUtilizadoOfTable, $dataInicio, $dataFim) {
        try {

            $sql = "UPDATE evento_equipamento_utilizado SET eve_equi_uti_fkequi_id = ?, eve_equi_uti_qtd = ?, eve_equi_uti_data_inicio = ?, eve_equi_uti_data_fim = ? WHERE eve_equi_uti_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $idEvento = 0;
            $qtd = '-';
            $p_sql->bindParam(1, $idEvento);
            $p_sql->bindParam(2, $qtd);
            $p_sql->bindParam(3, $dataInicio);
            $p_sql->bindParam(4, $dataFim);
            $p_sql->bindParam(5, $idMaterialUtilizadoOfTable);

            return $p_sql->execute();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
