<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class CorEventoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new CorEventoDao();
        }

        return self::$instance;
    }

    public function getObjCorEvento($row) {

        $corEvento = new CorEvento();
        $corEvento->setIdColorEvento($row->col_eve_id);
        $corEvento->setDescricaoColorEvento($row->col_eve_desc);
        $corEvento->setDescricaoInglesColorEvento($row->col_eve_desc_ingles);

        return $corEvento;
    }

    public function getListObjCorEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjCorEvento($row);
        }
        return $arr;
    }

    public function getCorEvento() {
        try {

            $sql = "SELECT * from color_eventos";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjCorEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getDescricaoCorEvento($corEvento) {
        try {

            $sql = "SELECT * from color_eventos WHERE col_eve_id = ?";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $corEvento);
            $p_sql->execute();

            return $this->getListObjCorEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
