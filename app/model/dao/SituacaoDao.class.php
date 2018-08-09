<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class SituacaoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new SituacaoDao();
        }

        return self::$instance;
    }

    public function getObjSituacao($row) {

        $situacao = new Situacao();
        $situacao->setId($row->sit_eve_id);
        $situacao->setDescricao($row->sit_eve_desc);

        return $situacao;
    }

    public function getListObjSituacao($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjSituacao($row);
        }
        return $arr;
    }

    public function getSituacao() {

        try {

            $sql = "SELECT * FROM situacao_evento";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);

            $p_sql->execute();

            return $this->getListObjSituacao($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
