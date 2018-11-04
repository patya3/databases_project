<div class="container-login">
    <img src="<?php if (isset($_SESSION["user"]) && $_SESSION["user"]["pic"] != "") echo $_SESSION["user"]["pic"]; else echo "./public/img/man.png";?>" alt="profile_pic">
    <br>
    <div class="">
        <?php if (isset($this->message)) echo $this->message; ?>
    </div>
        <form action="login" method="post">
            <div class="row-input">
                <input type="text" name="username" placeholder="Felhasználónév" maxlength="15" autofocus="autofocus" tabindex="1">
            </div>
            <div class="row-input">
                <input type="password" name="password" placeholder="Jelszó" maxlength="30" tabindex="2">
            </div>
            <input type="submit" name="login_submit" value="Bejelentkezés" class="login-button">
        </form>
</div>