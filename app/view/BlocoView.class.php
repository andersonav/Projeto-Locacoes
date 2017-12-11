<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlocoView
 *
 * @author Anderson Alves
 */
class BlocoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new BlocoView();

        return self::$instance;
    }

    public function htmlSelectBloco($blocos) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($blocos as $bloco) {
            ?>
            <option value="<?= $bloco->getIdBloco(); ?>"><?= $bloco->getDescricao(); ?></option>
            <?php
        }
    }

}
