<?php

class Index extends Controller {

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    private function init() {
        $categories = self::query("SELECT * FROM channel_categories");
        $data = array();

        foreach ($categories as $key => $cat) {
            $data[$cat["channel_category_name"]]["channels"] = self::stmt_query("SELECT channel_name FROM channels WHERE channel_category_id = ?","i",array($cat["id"]));
            $data[$cat["channel_category_name"]]["logo"] = self::stmt_query("SELECT channel_logo FROM channels WHERE channel_category_id = ? LIMIT 1", "i", array($cat["id"]))[0]["channel_logo"];
            $data[$cat["channel_category_name"]]["page"] = $cat["page"];
            $data[$cat["channel_category_name"]]["id"] = $cat["id"];
        }
        $this->view->data = $data;
    }

    public function display_favourites() {

    }
}