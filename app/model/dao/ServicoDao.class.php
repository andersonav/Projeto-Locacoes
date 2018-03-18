<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class ServicoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new ServicoDao();
        }

        return self::$instance;
    }

    public function getObjServico($row) {

        $servico = new Servico();
        $servico->setIdServico($row->ser_eve_id);
        $servico->setDescricaoServico($row->ser_eve_desc);

        return $servico;
    }

    public function getListObjServico($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjServico($row);
        }
        return $arr;
    }

    public function getServicos() {

        try {

            $sql = "SELECT * FROM servicos_evento";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjServico($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function verifyQtdDisponivelByQtdSolicitadaAndIdEquipamento($idEquipamento) {

        try {

            $sql = "SELECT * FROM servicos_evento ser WHERE ser.ser_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEquipamento);
            $p_sql->execute();

            return $this->getListObjServico($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function updateQtdDisponivelByIdServico($idEquipamento, $valorQtdisponivel) {

        try {

            $sql = "UPDATE equipamentos_evento equi SET equi.equi_eve_qtd = ? WHERE equi.equi_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorQtdisponivel);
            $p_sql->bindParam(2, $idEquipamento);
            return $p_sql->execute();
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
