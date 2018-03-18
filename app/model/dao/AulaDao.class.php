<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class AulaDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new AulaDao();
        }

        return self::$instance;
    }

    public function getObjAula($row) {

        $aula = new Aula();
        $aula->setIdAula($row->eve_aula_id);
        $aula->setDescricaoAula($row->eve_aula_desc);

        return $aula;
    }

    public function getListObjAula($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjAula($row);
        }
        return $arr;
    }

    public function getAula() {

        try {

            $sql = "SELECT * FROM evento_aula";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjAula($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
