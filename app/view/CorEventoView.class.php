<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CorEventoView
 *
 * @author Anderson Alves
 */
class CorEventoView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new CorEventoView();

        return self::$instance;
    }

    public function htmlSelectColorEvento($cores) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($cores as $cor) {
            ?>
            <option value="<?= $cor->getIdColorEvento(); ?>"><?= $cor->getDescricaoColorEvento(); ?></option>
            <?php
        }
    }

}
