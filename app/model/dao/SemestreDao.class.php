<?php

require_once '../autoload.php';

spl_autoload_register('autoloadBean');
spl_autoload_register('autoloadDB');

class SemestreDao {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new SemestreDao();
        }

        return self::$instance;
    }

    public function getObjSemestre($row) {

        $semestre = new Semestre();
        $semestre->setIdSemestre($row->sem_id);
        $semestre->setNomeSemestre($row->sem_nome);
        $semestre->setDataInicioSemestre($row->sem_data_inicio);
        $semestre->setDataFimSemestre($row->sem_data_fim);
        $semestre->setAtualIdSemestre($row->sem_atual);

        return $semestre;
    }

    public function getListObjSemestre($rows) {

        $arr = [];
        foreach ($rows as $row) {
            $arr[] = $this->getObjSemestre($row);
        }
        return $arr;
    }

    public function getDataBySemestre() {

        try {

            $sql = "SELECT * FROM semestres WHERE sem_atual = 1";
            $p_sql = ConexaoMysql::getInstance()->prepare($sql);
            $p_sql->execute();

            return $this->getListObjSemestre($p_sql->fetchAll(PDO::FETCH_OBJ));
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}
