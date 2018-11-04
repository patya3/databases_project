<div class="container-login">
    <img src="<?php if (isset($_SESSION["user"]) && $_SESSION["user"]["profile_picture"] != "") echo $_SESSION["user"]["profile_picture"]; else echo "public/img/man.png";?>" alt="profile_pic">
    <table>
        <tr>
            <th>Felhasználónév:</th>
            <td><?php echo $_SESSION["user"]["username"]; ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php echo $_SESSION["user"]["email"]; ?></td>
        </tr>
        <tr>
            <th>Név:</th>
            <td><?php echo $_SESSION["user"]["full_name"]; ?></td>
        </tr>
        <tr>
            <th>Regisztráció dátuma:</th>
            <td><?php echo $_SESSION["user"]["register_date"]; ?></td>
        </tr>
    </table>
    <br>
    <a href="index.php">Ugrás a főoldalra</a>
</div>