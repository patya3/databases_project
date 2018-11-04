<div class="container-login">
    <img src="public/img/man.png" alt="profile_pic"><br>
    <?php if (isset($this->errors) && !empty($this->errors)):?>
        <div class="alert alert-danger">
            <ul >
                <?php foreach ($this->errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="register" method="post" enctype="multipart/form-data">
        <div class="row-input">
            <label for="name">Név:</label><br>
            <input type="text" name="full_name" id="name" value="<?php if (isset($_POST['full_name'])) echo $_POST['full_name'] ?>" placeholder="Addja meg a nevét!" tabindex="1">
        </div>
        <div class="row-input">
            <label for="email">E-mail cím:</label><br>
            <input type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']?>" placeholder="Addja meg az e-mail címét!"
                   tabindex="2">
        </div>
        <div class="row-input">
            <label for="username">Felhasználónév:</label><br>
            <input type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>" placeholder="Addja meg a felhasználónevet!" maxlength="30" tabindex="4">
        </div>
        <div class="row-input">
            <label for="password1">Jelszó:</label><br>
            <input type="password" name="password1" id="password1" placeholder="Addja meg a jelszót!" maxlength="30" tabindex="5">
        </div>
        <div class="row-input">
            <label for="password2">Jelszó megerősítése:</label><br>
            <input type="password" name="password2" id="password2" placeholder="Addja meg a jelszót!" maxlength="30" tabindex="5">
        </div>
        <div class="row-input upload-btn">
            <label for="pic">Töltsön fel profilképet</label><br>
            <button>Fájl kiválasztása</button>
            <input type="file" name="pic" id="pic">
        </div>
        <br>
        <input type="submit" name="register_submit" value="Regisztráció" class="login-button">
    </form>
</div>