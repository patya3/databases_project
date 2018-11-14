<?php

Route::set('index.php', function () {
    $index = new Index();
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
        $favourites = new Favourites();
        $favourites->add_to_favourites();
    }
});