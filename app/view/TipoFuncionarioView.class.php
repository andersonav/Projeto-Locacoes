<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Contagem
 *
 * @author De3y4nn
 */
class TipoFuncionarioView {

    private static $instance;

    public function __construct() {
        
    }

    public static function getInstance() {

        if (!isset(self::$instance))
            self::$instance = new TipoFuncionarioView();

        return self::$instance;
    }

    public function htmlSelectTipoFuncionario($tipos) {
        ?>
        <option value="">SELECIONE O TIPO</option>
        <?php
        foreach ($tipos as $tipo) {
            ?>
            <option value="<?=$tipo->getId(); ?>"><?=$tipo->getDescricao(); ?></option>
            <?php
        }
    }
  
}
