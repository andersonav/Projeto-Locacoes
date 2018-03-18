<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class RefeicaoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new RefeicaoDao();
        }

        return self::$instance;
    }

    public function getObjRefeicao($row) {

        $refeicao = new Refeicao();
        $refeicao->setIdRefeicao($row->ref_eve_id);
        $refeicao->setDescricaoRefeicao($row->ref_eve_desc);
        $refeicao->setQuantidadeRefeicao($row->ref_eve_qtd);

        return $refeicao;
    }

    public function getListObjRefeicao($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjRefeicao($row);
        }
        return $arr;
    }

    public function getRefeicoes() {

        try {

            $sql = "SELECT * FROM refeicoes_evento";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjRefeicao($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function verifyQtdDisponivelByQtdSolicitadaAndIdRefeicao($idEquipamento) {

        try {

            $sql = "SELECT * FROM refeicoes_evento ser WHERE ser.ser_eve_id = ?";
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
