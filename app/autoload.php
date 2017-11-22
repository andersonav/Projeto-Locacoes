<?php

function autoloadBean($class, $dir = null) {

    if (is_null($dir)) {
        $dir = __DIR__ . '/model/bean/';
    }

    foreach (scandir($dir) as $file) {

        // directory?
        if (is_dir($dir . $file) && substr($file, 0, 1) !== '.') {
            autoloadBean($class, $dir . $file . '/');
        }

        // php file?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i", $file)) {

            // filename matches class?
            if (str_replace('.php', '', $file) == $class || str_replace('.class.php', '', $file) == $class) {
                include $dir . $file;
                break;
            }
        }
    }
}

function autoloadLogica($class, $dir = null) {

    if (is_null($dir)) {
        $dir = __DIR__ . '/model/logica/';
    }

    foreach (scandir($dir) as $file) {

        // directory?
        if (is_dir($dir . $file) && substr($file, 0, 1) !== '.') {
            autoloadBean($class, $dir . $file . '/');
        }

        // php file?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i", $file)) {

            // filename matches class?
            if (str_replace('.php', '', $file) == $class || str_replace('.class.php', '', $file) == $class) {
                include $dir . $file;
                break;
            }
        }
    }
}

function autoloadDao($class, $dir = null) {

    if (is_null($dir)) {
        $dir = __DIR__ . '/model/dao/';
    }

    foreach (scandir($dir) as $file) {

        // directory?
        if (is_dir($dir . $file) && substr($file, 0, 1) !== '.') {
            autoloadDao($class, $dir . $file . '/');
        }

        // php file?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i", $file)) {

            // filename matches class?
            if (str_replace('.php', '', $file) == $class || str_replace('.class.php', '', $file) == $class) {
                include $dir . $file;
                break;
            }
        }
    }
}

function autoloadView($class, $dir = null) {

    if (is_null($dir)) {
        $dir = __DIR__ . '/view/';
    }

    foreach (scandir($dir) as $file) {

        // directory?
        if (is_dir($dir . $file) && substr($file, 0, 1) !== '.') {
            autoloadView($class, $dir . $file . '/');
        }

        // php file?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i", $file)) {

            // filename matches class?
            if (str_replace('.php', '', $file) == $class || str_replace('.class.php', '', $file) == $class) {
                include $dir . $file;
                break;
            }
        }
    }
}

function autoloadDB($class, $dir = null) {

    if (is_null($dir)) {
        $dir = __DIR__ . '/model/db/';
    }
    foreach (scandir($dir) as $file) {

        // directory?
        if (is_dir($dir . $file) && substr($file, 0, 1) !== '.') {
            autoloadDB($class, $dir . $file . '/');
        }

        // php file?
        if (substr($file, 0, 2) !== '._' && preg_match("/.php$/i", $file)) {

            // filename matches class?
            if (str_replace('.php', '', $file) == $class || str_replace('.class.php', '', $file) == $class) {
                include $dir . $file;
                break;
            }
        }
    }
}

function autoloadCss($file) {
    if (file_exists('css/' . $file . '.css')) {
        echo "<link href='css/$file.css' rel='stylesheet' />\n";
    }
}

function autoloadPage($file) {
    if (file_exists('view/' . $file . '.php')) {
        require_once 'view/' . $file . '.php';
    }
}

function autoloadJs($file) {
    if (file_exists('js/' . $file . '.js')) {
        echo "<script src='js/$file.js'></script>";
    }
}
