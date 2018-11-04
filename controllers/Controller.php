<?php

class Controller extends Database {
    public $view;
    public function __construct() {
        $this->view = new View();
    }

    protected function redirect($page) {
        header("Location: ".$page);
    }
}