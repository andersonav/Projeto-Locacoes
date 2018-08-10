<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AmbienteView
 *
 * @author Anderson Alves
 */
class AmbienteView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new AmbienteView();

        return self::$instance;
    }

    public function htmlSelectAmbiente($ambientes) {
        ?>
        <option value="" disabled selected>Escolha sua opção</option>
        <?php
        foreach ($ambientes as $ambiente) {
            ?>
            <option value="<?= $ambiente->getIdAmbiente(); ?>"><?= $ambiente->getAmbienteDescricao(); ?></option>
            <?php
        }
    }

    public function htmlAmbiente($ambientes) {
        echo json_encode($ambientes);
    }

}
