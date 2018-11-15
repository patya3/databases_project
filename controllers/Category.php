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
        $show_data = array();
        $cats_data = array();

        $channels = self::stmt_query("SELECT id, channel_name, channel_logo, short_description FROM channels WHERE channel_category_id = ?","i",array($id));
        foreach ($channels as $c) {
            $show_data[$c["id"]]["name"] = $c["channel_name"];
            $show_data[$c["id"]]["logo"] = $c["channel_logo"];
            $show_data[$c["id"]]["shows"] = self::stmt_query("SELECT id, show_name, start_date FROM shows WHERE channel_id = ?","i",array($c["id"]));

            $cats_sql = "SELECT show_category_name ";
            $cats_sql .= "FROM show_categories ";
            $cats_sql .= "LEFT JOIN shows ON show_categories.id = shows.show_category_id ";
            $cats_sql .= "LEFT JOIN channels ON shows.channel_id = channels.id ";
            $cats_sql .= "WHERE shows.channel_id = ".$c["id"]." ";
            $cats_sql .= "GROUP BY show_category_name ";
            $cats_sql .= "LIMIT 5";
            $cats_data[$c["id"]] = self::query($cats_sql);
        }

        $this->view->shows = $show_data;
        $this->view->channels = $channels;
        $this->view->cats = $cats_data;
    }
}