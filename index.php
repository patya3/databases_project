<?php
require_once('Routes.php');

function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } elseif (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
    }
    if (file_exists("functions.php")) {
        require_once 'functions.php';
    }
}