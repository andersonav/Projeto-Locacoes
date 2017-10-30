<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class TipoRepeticaoDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new TipoRepeticaoDao();
        }

        return self::$instance;
    }

    public function getObjTipoRepeticao($row) {

        $tipo = new TipoRepeticao();
        $tipo->setIdTipoRepeticao($row->eve_tip_rep_id);
        $tipo->setDescricaoTipoRepeticao($row->eve_tip_rep_desc);

        return $tipo;
    }

    public function getListObjTipoRepeticao($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjTipoRepeticao($row);
        }
        return $arr;
    }

    public function getTipoRepeticao() {

        try {

            $sql = "SELECT * FROM evento_tipo_repeticao";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjTipoRepeticao($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
