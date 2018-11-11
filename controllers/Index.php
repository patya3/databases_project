<?php

class Index extends Controller {

    public function __construct() {
        parent::__construct();
        $categories = self::query("SELECT * FROM channel_categories");
        $data = array();
        foreach ($categories as $key => $cat) {
            $data[$cat["channel_category_name"]] = self::stmt_query("SELECT channel_name FROM channels WHERE channel_category_id = ?","i",array($cat["id"]));
            //file_put_contents("kecske.txt", print_r($cat['id'], true), FILE_APPEND);
        }
        $this->view->data = $data;
    }

    public function display_favourites() {

    }
}