<?php


function header_code($current = "")
{
    $current = $_GET["url"];
?>
    <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Műsorújság</title>
    <link rel="stylesheet" type="text/css" href="<?php echo public_url("/public/css/navbar.css")?>">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url("/public/css/font-awesome.css")?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo public_url("/public/css/style.css")?>">
    <link rel="stylesheet" type="text/css" href="<?php echo public_url("/public/css/responsive.css")?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script src="<?php echo public_url("/public/js/notify.min.js")?>"></script>
    <script type="text/javascript" src="<?php echo public_url("/public/js/ajax.js")?>"></script>
    <?php if ($current == "login" || $current == "register") echo "<link rel='stylesheet' type='text/css' href='".public_url("/public/css/login.css")."'>" ?>

</head>
<body>
<header>
    <div class="container">
        <a href="index.php">
            <div id="branding">
                <h1><span class="highlight">Műsor</span>újság</h1>
            </div>
        </a>
        <nav>
            <a href="#" id="menu-icon"></a>
            <ul>
                <li class="<?php if ($current == "comedy") echo "current"; ?>"><a href="index.php" class="nav-options">Szórakoztató
                        csatornák</a></li>
                <li class="<?php if ($current == "nature") echo "current"; ?>"><a href="index.php" class="nav-options">Ismeretterjesztő
                        csatornák</a></li>
                <li class="<?php if ($current == "sport") echo "current"; ?>"><a href="index.php" class="nav-options">Sport
                        csatornák</a></li>
                <li class="dropdown">
                    <img src="<?php if (isset($_SESSION["user"]) && $_SESSION["user"]["pic"] != "") echo $_SESSION["user"]["pic"]; else echo "./public/img/nobody_m.original.jpg";?>" alt="nobody" class="dropdownbuttton">
                    <div class="dropdown-content">
                        <a href="index.php"><?php if(isset($_SESSION["user"])) echo "Fiók"; else echo "Bejelentkezés";?></a>
                        <?php if (isset($_SESSION["user"])) : ?>
                            <a onclick="logout()">Kijelentkezés</a>
                        <?php else: ?>
                            <a href="index.php">Regisztráció</a>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="<?php if ($current == "login") echo "current"; ?>"><a href="index.php">Bejelentkezés</a></li>
                <li class="<?php if ($current == "sign") echo "current"; ?>"><a href="index.php">Regisztráció</a></li>
            </ul>
        </nav>
    </div>
</header>

<?php
}
function footer_code() {
    ?>
    <footer>
        <p>Patya Web Development, Copyright &copy; 2018</p>
    </footer>

    </body>
    </html>
    <?php
}

function public_url($url = "") {
    return "/".basename(__DIR__).$url;
}