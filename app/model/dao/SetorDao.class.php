<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class SetorDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new SetorDao();
        }

        return self::$instance;
    }

    public function getObjSetor($row) {

        $setor = new Setor();
        $setor->setId($row->set_eve_id);
        $setor->setDescricao($row->set_eve_desc);

        return $setor;
    }

    public function getListObjSetor($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjSetor($row);
        }
        return $arr;
    }

    public function getSetor() {

        try {

            $sql = "SELECT * FROM setor_evento WHERE set_eve_ativo = 1";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);

            $p_sql->execute();

            return $this->getListObjSetor($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
