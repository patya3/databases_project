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
        $user_favorites = array();
        $sql_favorites = "SELECT DATE_FORMAT(start_date,'%H:%i') as time, show_name, channels.id as channel_id".
            " FROM shows, users, users_favorites, channels".
            " WHERE shows.channel_id = channels.id AND".
            " users.id = users_favorites.user_id AND".
            " channels.id = users_favorites.channel_id AND".
            " WEEKDAY(shows.start_date) = 3";

        $user_favorites = self::query($sql_favorites);
        $channels = self::query("SELECT channels.id as id, channel_name, channel_logo, channel_categories.id as cat_id, page FROM channels, channel_categories WHERE channels.channel_category_id = channel_categories.id");

        $view_favorites = array();
        foreach ($user_favorites as $f) {
            foreach ($channels as $c) {
                if ($f["channel_id"] == $c["id"]) {
                    $view_favorites[$c["id"]]["c_name"] = $c["channel_name"];
                    $view_favorites[$c["id"]]["c_logo"] = $c["channel_logo"];
                    $view_favorites[$c["id"]]["url"] = $c["page"]."-".$c["cat_id"];
                    $view_favorites[$c["id"]]["shows"][] = array(
                        "time" => $f["time"],
                        "name" => $f["show_name"]
                    );
                }
            }
        }
        $this->view->favorites = $view_favorites;
    }
}