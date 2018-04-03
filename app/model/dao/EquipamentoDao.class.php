<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class EquipamentoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new EquipamentoDao();
        }

        return self::$instance;
    }

    public function getObjEquipamento($row) {

        $equipamento = new Equipamento();
        $equipamento->setIdEquipamento($row->equi_eve_id);
        $equipamento->setDescricaoEquipamento($row->equi_eve_desc);
        $equipamento->setQuantidadeEquipamento($row->equi_eve_qtd);

        return $equipamento;
    }

    public function getListObjEquipamento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjEquipamento($row);
        }
        return $arr;
    }

    public function getEquipamentos() {

        try {

            $sql = "SELECT * FROM equipamentos_evento WHERE equi_eve_qtd > 0";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjEquipamento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function verifyQtdDisponivelByQtdSolicitadaAndIdEquipamento($idEquipamento) {

        try {

            $sql = "SELECT * FROM equipamentos_evento equi WHERE equi.equi_eve_id = ? AND equi_eve_qtd > 0";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEquipamento);
            $p_sql->execute();

            return $this->getListObjEquipamento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateQtdDisponivelByIdEquipamento($idEquipamento, $valorAtual) {

        try {

            $sql = "UPDATE equipamentos_evento equi SET equi.equi_eve_qtd = ? WHERE equi.equi_eve_id = ? AND equi_eve_qtd > 0";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorAtual);
            $p_sql->bindParam(2, $idEquipamento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
