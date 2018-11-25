<?php

class Admin extends Controller {

    private $channels;
    private $shows;
    private $show_categories;

    public function __construct() {
        parent::__construct();
        $this->init();
    }

    private function init() {
        $this->channels = $this->view->channels = self::query("SELECT id, channel_name FROM channels");
        $this->shows = $this->view->shows = self::query("SELECT * FROM shows");
        $this->show_categories = $this->view->show_categories = self::query("SELECT * FROM show_categories");
        $this->actors = $this->view->actors = self::query("SELECT * FROM actors");
    }

    public function delete_show() {
        if (isset($_POST["delete_show"])) {
            self::stmt_query("DELETE FROM shows WHERE shows.id= ?","i",array($_POST["id"]));
            $this->view->delete_message = "Sikeres törlés.";
        }
        $this->redirect("admin");
    }

    public function update_show() {
        if (isset($_POST["update_show"])) {
            $errors = array();
            $actor_ids = "";
            if (!isset($_POST["id"])) {
                $errors[] = "Nem lett műsor kiválasztva.";
            }
            if (!isset($_POST["show_name"]) || strlen($_POST["show_name"]) < 3) {
                $errors[] = "A műsor címének legalább 3 karakternek kell lennie.";
            }
            if (!isset($_POST["channel_id"])) {
                $errors[] = "Nem lett csatorna kiválasztva";
            }
            if (!isset($_POST["show_category_id"])) {
                $errors[] = "Nem lett kategória kiválasztva";
            }
            if (!isset($_POST["start_date"]) || !isset($_POST["end_date"])) {
                $errors[] = "A kezdés és a befejezés dátuma nem lehet üres.";
            }
            if ($_POST["start_date"] == $_POST["end_date"]) {
                $errors[] = "A kezdés ideje és a befejezés ideje nem lehet egyenlő.";
            }
            if (isset($_POST["actor_ids"])) {
                for ($i = 0; $i < count($_POST["actor_ids"]); $i++) {
                    $join = ($i != count($_POST["actor_ids"])- 1) ? "," : "";
                    $actor_ids .= $_POST["actor_ids"][$i].$join;
                }
            }

            if (count($errors) == 0) {
                self::stmt_query("UPDATE shows SET show_name = ?, channel_id = ?, show_category_id = ?, start_date = STR_TO_DATE(?,'%Y-%m-%dT%H:%i'), end_date = STR_TO_DATE(?,'%Y-%m-%dT%H:%i'), actor_ids = ? WHERE id = ?",
                    "siisssi",array($_POST["show_name"], $_POST["channel_id"], $_POST["show_category_id"], $_POST["start_date"], $_POST["end_date"], $actor_ids, $_POST["id"])
                );
                $this->view->update_message = "Sikeres módosítás";
            } else {
                $this->view->update_errors = $errors;
            }
        }
        //$this->redirect("admin");
    }

    public function add_show() {
        if (isset($_POST["add_show"])) {
            $errors = array();
            $actor_ids = "";
            if (!isset($_POST["channel_id"])) {
                $errors[] = "Nem lett csatorna kiválasztva.";
            }
            if (!isset($_POST["show_name"]) || strlen($_POST["show_name"]) < 3) {
                $errors[] = "A címe nem lehet üres és legalább 3 karakternek kell lennie.";
            }
            if (!isset($_POST["show_category_id"])) {
                $errors[] = "Nem lett kategória kiválasztva.";
            }
            if (!isset($_POST["start_date"]) || !isset($_POST["end_date"])) {
                $errors[] = "A kezdés és a befejezés dátuma nem lehet üres.";
            }
            if ($_POST["start_date"] == $_POST["end_date"]) {
                $errors[] = "A kezdés ideje és a befejezés ideje nem lehet egyenlő.";
            }
            if (isset($_POST["actor_ids"])) {
                for ($i = 0; $i < count($_POST["actor_ids"]); $i++) {
                    $join = ($i != count($_POST["actor_ids"])- 1) ? "," : "";
                    $actor_ids .= $_POST["actor_ids"][$i].$join;
                }
            }

            foreach ($this->shows as $show) {
                if ($show["show_name"] == $_POST["show_name"] && $show["channel_id"] == $_POST["channel_id"] &&
                    $show["show_category_id"] == $_POST["show_category_id"] && $show["start_date"] == $_POST["start_date"]) {
                    $errors[] = "Az adott műsor már szerepel az adatbázisban.";
                    break;
                }
            }

            if (count($errors) == 0) {
                self::stmt_query("INSERT INTO shows (show_name, channel_id, show_category_id, start_date, end_date, actor_ids) VALUES (?,?,?,STR_TO_DATE(?,'%Y-%m-%dT%H:%i'),STR_TO_DATE(?,'%Y-%m-%dT%H:%i'),?)",
                    "siisss",array($_POST["show_name"], $_POST["channel_id"], $_POST["show_category_id"], $_POST["start_date"], $_POST["end_date"], $actor_ids)
                );
                $this->view->add_message = "Sikeres hozzáadás!";
            } else {
                $this->view->add_errors = $errors;
            }

        }
        //$this->redirect("admin");
    }
}