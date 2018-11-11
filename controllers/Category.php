<?php
class Category extends Controller {

    private $uri;

    public function __construct($uri) {
        parent::__construct();
        $this->init($uri);
    }

    private function init($uri) {
        $arr = explode("/", $uri);
        $current_page_uri = $arr[max(array_keys($arr))];
        $arr2 = explode("-",$current_page_uri);
        $id = $arr2[max(array_keys($arr2))];

        //view array
        $data = array();

        $channels = self::stmt_query("SELECT id, channel_name, channel_logo FROM channels WHERE channel_category_id = ?","i",array($id));
        $i = 0;
        foreach ($channels as $c) {
            $data[$i]["name"] = $c["channel_name"];
            $data[$i]["logo"] = $c["channel_logo"];
            $data[$i]["shows"] = self::stmt_query("SELECT show_name, date FROM shows WHERE channel_id = ?","i",array($c["id"]));
            $i++;
        }
        $this->view->data = $data;
    }

    public function add_to_favourites() {

    }
}