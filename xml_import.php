<?php
require_once "./classes/Database.php";

$database = new Database();

$con = mysqli_connect("localhost","root","");
$xml = simplexml_load_file("./sql/guide.xml");

$channels_in_db = $database::query("SELECT channel_id FROM channels");
$channel_ids = array();
foreach ($channels_in_db as $ch_id) {
    $channel_ids[] = $ch_id["channel_id"];
}

/*$shows_in_db = $database::query("SELECT channel_id FROM channels");
$show_ids = array();
foreach ($shows_in_db as $show_id) {
    $show_ids[] = $show_id["id"];
}*/

$i = 0;
$nature = array("NATGEO","DISCOVERY","ANIMAL","HISTORY","SPEKTRUM");
$sport = array("DIGISPORT1","SPORT1","SPORT2","EUROSPORT","M4_SPORT");
$comedy = array("RTL","VIASAT3","TV2","COMEDY","FILMPLUS");

//channels tábla feltöltése
foreach ($xml->channel as $channel) {
    if (in_array($channel["id"],$nature) && !in_array($channel["id"], $channel_ids)) {
        $channel_name = $channel->display_name;
        $channel_category_id = 2;
        $channel_logo = $channel->icon["src"];
        $channel_id = $channel["id"];
        $database::stmt_query("INSERT INTO channels (channel_name, channel_category_id, channel_logo, channel_id) VALUES (?,?,?,?)","siss",array($channel_name,$channel_category_id, $channel_logo, $channel_id));
    } else if (in_array($channel["id"],$sport) && !in_array($channel["id"], $channel_ids)) {
        $channel_name = $channel->display_name;
        $channel_category_id = 3;
        $channel_logo = $channel->icon["src"];
        $channel_id = $channel["id"];
        $database::stmt_query("INSERT INTO channels (channel_name, channel_category_id, channel_logo, channel_id) VALUES (?,?,?,?)","siss",array($channel_name,$channel_category_id, $channel_logo, $channel_id));
    } else if (in_array($channel["id"],$comedy) && !in_array($channel["id"], $channel_ids)) {
        $channel_name = $channel->display_name;
        $channel_category_id = 1;
        $channel_logo = $channel->icon["src"];
        $channel_id = $channel["id"];
        $database::stmt_query("INSERT INTO channels (channel_name, channel_category_id, channel_logo, channel_id) VALUES (?,?,?,?)","siss",array($channel_name,$channel_category_id, $channel_logo, $channel_id));
    }
}

//drop all rows
$database::$con->query("TRUNCATE `tv_guide`.`show_categories`");

$show_categories = $database::query("SELECT show_category_name FROM show_categories");
$show_cats = array();
foreach ($show_categories as $show_cat) {
    $show_cats[] = $show_cat["show_category_name"];
}

//show_categories insert and update
foreach ($xml->programme as $show) {
    if (!empty($show->sub_title)) {
        if (strpos($show->sub_title,",")) {
            $category_name = explode(",",$show->sub_title)[0];
        } else if (!strpos($show->sub_title, "/") && !preg_match('~[0-9]+~',  $show->sub_title)) {
            $category_name = $show->sub_title;
        }
    }
    if (in_array($show["channel"], $nature) && !in_array($category_name, $show_cats)) {
        $database::stmt_query("INSERT INTO show_categories (show_category_name) VALUES (?)","s",array($category_name));
        $show_categories = $database::query("SELECT show_category_name FROM show_categories");
        $show_cats = array();
        foreach ($show_categories as $show_cat) {
            $show_cats[] = $show_cat["show_category_name"];
        }
    } else if (in_array($show["channel"], $sport) && !in_array($category_name, $show_cats)) {
        $database::stmt_query("INSERT INTO show_categories (show_category_name) VALUES (?)","s",array($category_name));
        $show_categories = $database::query("SELECT show_category_name FROM show_categories");
        $show_cats = array();
        foreach ($show_categories as $show_cat) {
            $show_cats[] = $show_cat["show_category_name"];
        }
    } else if (in_array($show["channel"], $comedy) && !in_array($category_name, $show_cats)) {
        $database::stmt_query("INSERT INTO show_categories (show_category_name) VALUES (?)","s",array($category_name));
        $show_categories = $database::query("SELECT show_category_name FROM show_categories");
        $show_cats = array();
        foreach ($show_categories as $show_cat) {
            $show_cats[] = $show_cat["show_category_name"];
        }
    }
}

$database::$con->query("TRUNCATE `tv_guide`.`shows`");

//show insert and update
foreach ($xml->programme as $show) {
    if (in_array($show["channel"],$nature)) {
        $show_name = $show->title;
        foreach ($show_cats as $cat) {
            if (strpos($show->sub_title, $cat))
                $category = $cat;
        }
        $channel_id = $database::stmt_query("SELECT id FROM channels WHERE channel_id = ?","s",array($show["channel"]))[0]["id"];
        if (!empty($category))
            $category_id = $database::stmt_query("SELECT id FROM show_categories WHERE show_category_name = ?","s",array($category))[0]["id"];
        else
            $category_id = 0;

        $start_date_raw = (string) $show["start"];
        $end_date_raw = (string) $show["stop"];

        $database::stmt_query("INSERT INTO shows (show_name, channel_id, show_category_id, start_date,end_date) VALUES (?,?,?,STR_TO_DATE(?,'%Y%m%d%H%i%s'),STR_TO_DATE(?,'%Y%m%d%H%i%s'))","siidd",array(
            $show_name, $channel_id, $category_id, $start_date_raw, $end_date_raw
        ));
    } else if (in_array($show["channel"],$sport)) {
        $show_name = $show->title;
        foreach ($show_cats as $cat) {
            if (strpos($show->sub_title, $cat))
                $category = $cat;
        }
        $channel_id = $database::stmt_query("SELECT id FROM channels WHERE channel_id = ?","s",array($show["channel"]))[0]["id"];
        if (!empty($category))
            $category_id = $database::stmt_query("SELECT id FROM show_categories WHERE show_category_name = ?","s",array($category))[0]["id"];
        else
            $category_id = 0;

        $start_date_raw = (string) $show["start"];

        $end_date_raw = (string) $show["stop"];

        $database::stmt_query("INSERT INTO shows (show_name, channel_id, show_category_id, start_date,end_date) VALUES (?,?,?,STR_TO_DATE(?,'%Y%m%d%H%i%s'),STR_TO_DATE(?,'%Y%m%d%H%i%s'))","siidd",array(
            $show_name, $channel_id, $category_id, $start_date_raw, $end_date_raw
        ));
    } else if (in_array($show["channel"],$comedy)) {
        $show_name = $show->title;
        foreach ($show_cats as $cat) {
            if (strpos($show->sub_title, $cat))
                $category = $cat;
        }
        $channel_id = $database::stmt_query("SELECT id FROM channels WHERE channel_id = ?","s",array($show["channel"]))[0]["id"];
        if (!empty($category))
            $category_id = $database::stmt_query("SELECT id FROM show_categories WHERE show_category_name = ?","s",array($category))[0]["id"];
        else
            $category_id = 0;

        $start_date_raw = (string) $show["start"];
        $end_date_raw = (string) $show["stop"];

        $database::stmt_query("INSERT INTO shows (show_name, channel_id, show_category_id, start_date,end_date) VALUES (?,?,?,STR_TO_DATE(?,'%Y%m%d%H%i%s'),STR_TO_DATE(?,'%Y%m%d%H%i%s'))","siidd",array(
            $show_name, $channel_id, $category_id, $start_date_raw, $end_date_raw
        ));
    }
}