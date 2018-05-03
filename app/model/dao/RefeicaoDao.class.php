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

    public function getRefeicaoNotInEvento($idEvento) {

        try {

            $sql = "SELECT * FROM refeicoes_evento
                    WHERE ref_eve_id NOT IN (SELECT eve_ref_uti_fkref_id FROM evento_refeicao_utilizado WHERE eve_ref_uti_fkeve_id = ?)";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idEvento);
            $p_sql->execute();

            return $this->getListObjRefeicao($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
