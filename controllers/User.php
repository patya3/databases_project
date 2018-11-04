<?php

class User extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login () {

        if (isset($_POST["login_submit"])) {
            $users = self::query("SELECT * FROM users");
            $username = $_POST["username"];
            $password = $_POST["password"];
            $message = "Hibás felhasználónév vagy jelszó";

            foreach ($users as $user) {
                if ($user["username"] == $username && $user["password"] == $password) {
                    $_SESSION["user"] = $user;
                    $message = "Sikeres bejelentkezés!";
                    break;
                }
            }
        }
        $this->view->message = $message;
    }

    public function logout() {
        session_unset();
        if(session_destroy()) {
            echo true;
        }
        echo false;
    }

    public function register () {
        if (isset($_POST['register_submit'])) {
            $errors = [];
            $message = "";
            $users = self::query("SELECT username, email FROM users");
            $username = $_POST["username"];
            $password1 = $_POST["password1"];
            $password2 = $_POST["password2"];
            $full_name = $_POST["full_name"];
            $email = $_POST["email"];
            $favorites = "";
            $register_date = date("Y-m-d");
            foreach ($users as $user) {
                if ($user["username"] == $username) {
                    $errors[] = "Foglalt felhasználónév.";
                    break;
                }
            }
            foreach ($users as $user) {
                if ($user["email"] == $email) {
                    $errors[] = "Foglalt email cím.";
                    break;
                }
            }

            //validate
            if (strlen($username) > 20 || strlen($username) < 4) {
                $errors[] = "A felhasználónév hosszának 3 és 20 karakter között kell lennie.";
            } elseif (strlen($password1) < 6) {
                $errors[] = "Túl rövid a jelszó.";
            } elseif (!(preg_match('~[A-Z]~', $password1) && preg_match('~\d~', $password1))) {
                $errors[] = "Legalább egy nagybetűnek és egy számnak kell lennie a jelszóban.";
            } elseif ($password1 != $password2) {
                $errors[] = "Nem egyezik a két jelszó.";
            }
            if (strlen($full_name) == 0) {
                $errors[] = "Add meg kérlek a neved.";
            }

            //kep feltoltese
            $pic = "";
            if (isset($_FILES["pic"]) && $_FILES["pic"]["tmp_name"] != "") {

                if($_FILES["pic"]["size"] > 2097152) {
                    $errors[] = "Maximum 2MB-os képet tölthetsz fel.";
                }

                $pic_info = getimagesize($_FILES["pic"]["tmp_name"]);
                $extension = $pic_info["mime"];

                if ($extension != "image/jpeg" && $extension != "image/png") {
                    $errors[] = "Csak jpg vagy png kiterjesztés engedélyezett.";
                }
                $hash = md5_file($_FILES["pic"]["tmp_name"]);
                $pic = "../public/img/profile_images/".$hash;
            }
            $this->view->errors = $errors;

            //user mentese ha nincs validalasi hiba
            if (sizeof($errors) == 0) {
                $message = "Sikeres regisztráció!";

                if ($pic != "") {
                    move_uploaded_file($_FILES["pic"]["tmp_name"], $pic);
                }
                self::stmt_query("INSERT INTO users (username, password, email, full_name, profile_picture, register_date) VALUES (?,?,?,?,?,?);","sssssd", array($username, $password1, $email, $full_name, $pic, $register_date));
                $this->redirect('login');
            }
        }

    }
}