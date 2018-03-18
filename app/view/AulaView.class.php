<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AulaView
 *
 * @author Anderson Alves
 */
class AulaView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new AulaView();

        return self::$instance;
    }

    public function htmlSelectAula($aulas) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($aulas as $aula) {
            ?>
            <option value="<?= $aula->getIdAula(); ?>"><?= $aula->getDescricaoAula(); ?></option>
            <?php
        }
    }

}
