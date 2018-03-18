<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class TipoFuncionarioDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)){
            self::$instance = new TipoFuncionarioDao();
        }

        return self::$instance;
    }

    public function getObjTipoFuncionarios($row) {

        $tipo = new TipoFuncionario();
        $tipo->setId($row->tip_id);
        $tipo->setDescricao($row->tip_descricao);

        return $tipo;
    }

    public function getListTipoFuncionario($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjTipoFuncionarios($row);
        }
        return $arr;
    }

    public function getTipoFuncionario() {

        try {

            $sql = "SELECT * FROM tipo_usuario";

            $p_sql = ConexaoMysql::getInstance()->prepare($sql);

            $p_sql->execute();

            return $this->getListTipoFuncionario($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }
   

}
