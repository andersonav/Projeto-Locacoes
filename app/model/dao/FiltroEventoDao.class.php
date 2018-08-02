<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class FiltroEventoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new FiltroEventoDao();
        }

        return self::$instance;
    }

    public function getObjFiltroEvento($row) {

        $filtroEvento = new FiltroEvento();
        $filtroEvento->setId($row->fil_eve_id);
        $filtroEvento->setDescricao($row->fil_eve_desc);

        return $filtroEvento;
    }

    public function getListObjFiltroEvento($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjFiltroEvento($row);
        }
        return $arr;
    }

    public function getFiltroEvento() {

        try {

            $sql = "SELECT * FROM filtro_evento";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);

            $p_sql->execute();

            return $this->getListObjFiltroEvento($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
