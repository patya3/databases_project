<?php

Route::set('index.php', function () {
    $index = new Index();

    if (isset($_SESSION["user"])) {
        $index->display_favourites();
    }

    $index->view->render("Index");
});

Route::set('login', function () {
    $user = new User();

    if (isset($_POST['login_submit'])) {
        $user->login();
    }
    if (!isset($_SESSION['user']) && $_GET['url'] == 'login') {
        $user->view->render('Login');
    } else {
        $user->view->render('Profile');
    }
});

Route::set('register', function () {
    $user = new User();

    if (isset($_POST['register_submit'])) {
        $user->register();
    }
    if (!isset($_SESSION['user']) && $_GET['url'] == 'register') {
        $user->view->render('Register');
    } else {
        $user->view->render('Profile');
    }
});

Route::set('logout', function () {
   $user = new User();
   $user->logout();
});

Route::set('category', function () {
    $category = new Category($_SERVER["REQUEST_URI"]);
    $category->view->render("Category");
});

Route::set('add-to-fav', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $favorites = new Favorites();
        $favorites->add_to_favourites();
    }
});

Route::set('favorites', function () {
   $favorites = new Favorites();
   if (isset($_SESSION["user"])) {
       $favorites->display_favorites();
       $favorites->view->render("Favorites");
   } else {
       header("Location: ".public_url());
   }

});

Route::set('admin', function () {
    //check if user have permission to reach admin page
    $admin = new Admin();

    if (isset($_SESSION["user"]) && $_SESSION["user"]["id"] == 1) {
        if (isset($_POST["add_show"])) {
            $admin->add_show();
        }
        if (isset($_POST["delete_show"])) {
            $admin->delete_show();
        }
        if (isset($_POST["update_show"])) {
            $admin->update_show();
        }
        $admin->view->render("Admin");
    } else {
        header("Location: ".public_url());
    }
});