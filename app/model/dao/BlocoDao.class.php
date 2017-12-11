<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class BlocoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new BlocoDao();
        }

        return self::$instance;
    }

    public function getObjBloco($row) {

        $bloco = new Bloco();
        $bloco->setIdBloco($row->blo_eve_id);
        $bloco->setIdSetor($row->blo_set_eve_id);
        $bloco->setDescricao($row->blo_eve_desc);

        return $bloco;
    }

    public function getListObjBloco($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjBloco($row);
        }
        return $arr;
    }

    public function getBlocoBySetor($idSetor) {

        try {

            $sql = "SELECT * FROM bloco_evento WHERE blo_set_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $idSetor);
            $p_sql->execute();

            return $this->getListObjBloco($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
