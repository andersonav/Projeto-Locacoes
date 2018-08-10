<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class AmbienteDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new AmbienteDao();
        }

        return self::$instance;
    }

    public function getObjAmbiente($row) {

        $ambiente = new Ambiente();
        $ambiente->setIdAmbiente($row->amb_eve_id);
        $ambiente->setAmbienteDescricao($row->amb_eve_desc);
        $ambiente->setAmbienteIdBloco($row->amb_blo_eve_id);
        $ambiente->setAmbienteBlocoDescricao($row->blo_eve_desc);
        $ambiente->setAmbienteIdSetor($row->set_eve_id);
        $ambiente->setAmbienteSetorDescricao($row->set_eve_desc);

        return $ambiente;
    }

    public function getListObjAmbiente($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjAmbiente($row);
        }
        return $arr;
    }

    public function getAmbienteByBloco($valorBloco) {

        try {

            $sql = "SELECT * FROM ambiente_evento amb
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id
                    JOIN setor_evento sev ON sev.set_eve_id=blo.blo_set_eve_id 
                    WHERE blo.blo_eve_id = ? AND blo.blo_ativo = 1 AND amb.amb_ativo = 1 ORDER BY amb_eve_desc";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->bindParam(1, $valorBloco);
            $p_sql->execute();

            return $this->getListObjAmbiente($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

    public function getAmbiente() {

        try {

            $sql = "SELECT * FROM ambiente_evento amb
                    JOIN bloco_evento blo ON blo.blo_eve_id = amb.amb_blo_eve_id
                    JOIN setor_evento sev ON sev.set_eve_id=blo.blo_set_eve_id 
                    ORDER BY amb_eve_desc";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjAmbiente($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
