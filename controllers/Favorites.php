<?php

class Favorites extends Controller {

    public function __construct() {
        parent::__construct();
    }

    //kedvenc csatorna hozzadasa (adatabazisba valo feltoltese)
    public function add_to_favourites() {
        $response = "";
        if (isset($_POST["channel_id"]) && isset($_SESSION["user"])) {
            $channel_id = $_POST["channel_id"];
            $user_id = $_SESSION["user"]["id"];

            $users_favourites = self::query("SELECT * FROM users_favorites");

            $in_db = false;
            foreach ($users_favourites as $uf) {
                if ($uf["user_id"] == $user_id && $uf["channel_id"] == $channel_id) {
                    $in_db = true;
                    break;
                }
            }

            //insert a db-be, ha nincs meg benne ez a user_id-channel_id parositas
            if ($in_db == false) {
                self::stmt_query("INSERT INTO users_favorites (user_id, channel_id) VALUES (?,?)","ii",array($user_id, $channel_id));
                $response = 1;
            } else {
                $response = 0;
            }
        } else {
            $response = -1;
        }
        echo json_encode($response);
    }

    public function display_favorites() {
        $favorite_channels = array();
        $channel_categories = self::query("SELECT page FROM channel_categories");
        foreach ($channel_categories as $chan_cat) {
            $fav_sql = "".
            "SELECT channel_name".
            " FROM users_favorites".
            " LEFT JOIN users ON users_favorites.user_id = users.id".
            " LEFT JOIN channels ON users_favorites.channel_id = channels.id".
            " LEFT JOIN channel_categories ON channels.channel_category_id = channel_categories.id".
            " WHERE channels.channel_category_id IN (SELECT id FROM channel_categories WHERE PAGE LIKE '%".$chan_cat["page"]."%' ) AND".
                  " users.id = ".$_SESSION["user"]["id"].
            " ORDER BY page ASC";
            $result = self::query($fav_sql);
            foreach ($result as $r) {
                $favorite_channels[$chan_cat["page"]][] = $r["channel_name"];
            }
        }
        $statistics_sql = "".
            "SELECT show_category_name, COUNT(*) as amount ".
            "FROM show_categories ".
            "LEFT JOIN shows ON shows.show_category_id = show_categories.id ".
            "LEFT JOIN channels ON shows.channel_id = channels.id ".
            "LEFT JOIN users_favorites ON channels.id = users_favorites.channel_id ".
            "LEFT JOIN users ON users.id = users_favorites.user_id ".
            "WHERE users.id = ".$_SESSION["user"]["id"].
            " GROUP BY show_category_name";
        $statistics = self::query($statistics_sql);


        $this->view->statistics = $statistics;
        $this->view->favorites = $favorite_channels;
    }
}