<?php

require_once '../autoload.php';
spl_autoload_register('autoloadLogica');

$acao = explode(".", filter_input(INPUT_POST, 'action'), 2);
$classe = $acao[0];
$metodo = $acao[1];

return $classe::getInstance()->$metodo(filter_input_array(INPUT_POST));