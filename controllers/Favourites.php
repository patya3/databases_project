<?php

class Favourites extends Controller {

    public function __construct() {
        parent::__construct();
    }

    //kedvenc csatorna hozzadasa (adatabazisba valo feltoltese)
    public function add_to_favourites() {
        $response = "";
        if (isset($_POST["channel_id"]) && isset($_SESSION["user"])) {
            $channel_id = $_POST["channel_id"];
            $user_id = $_SESSION["user"]["id"];

            $users_favourites = self::query("SELECT * FROM users_favourites");

            $in_db = false;
            foreach ($users_favourites as $uf) {
                if ($uf["user_id"] == $user_id && $uf["channel_id"] == $channel_id) {
                    $in_db = true;
                    break;
                }
            }

            //insert a db-be, ha nincs meg benne ez a user_id-channel_id parositas
            if ($in_db == false) {
                self::stmt_query("INSERT INTO users_favourites (user_id, channel_id) VALUES (?,?)","ii",array($user_id, $channel_id));
                $response = 1;
            } else {
                $response = 0;
            }
        } else {
            $response = -1;
        }
        echo json_encode($response);
    }
}