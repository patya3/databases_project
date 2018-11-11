<?php

class View {

    public function render($view) {
        header_code();
        require_once "./views/".$view.".php";
        footer_code();
    }

    public static function static_render($view) {
        header_code();
        require_once "./views/".$view.".php";
        footer_code();
    }
}