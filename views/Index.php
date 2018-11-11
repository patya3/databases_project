
<a id="top"></a>
<section id="showcase">
    <div class="container">
        <h1>Tv-s műsorújság</h1>
        <p>Üdvözöllek az oldalon, remélem megtalálod azt a műsort, amit keresel!</p>
    </div>
</section>
<section id="boxes">
    <div class="container">
    <?php print_r($this->data)?>
        <div class="box">
            <a href="comedy.php"><img src="./img/tv2_logo.png" alt="szorakoztato"></a>
            <a href="comedy.php"><h3>Szórakoztató csatornák</h3></a>
            <p>RTL Klub, TV2, Comedy Central, Film+, Viasat3</p>
        </div>
        <div class="box">
            <a href="nature.php"><img src="img/download.png" alt="ismeret_terjeszto"></a>
            <a href="nature.php"><h3>Ismeretterjesztő csatornák</h3></a>
            <p>Animal Planet, Discovery Channel, National Geographic, History Channel, Spektrum</p>
        </div>
        <div class="box">
            <a href="sport.php"><img src="./img/sport1_logo.jpg" alt="sport"></a>
            <a href="sport.php"><h3>Sport csatornák</h3></a>
            <p>Sport 1, Sport 2, Eurosport HD, Digi Sport 1, M4 sport</p>
        </div>
    </div>
</section>
<section id="favourites">
    <div class="container">
        <h1><?php if (isset($_SESSION["user"])) echo "Lentebb láthatja kedvenc csatornái aktuális műsorát!"; else echo "Jelentkezzen be, hogy láthassa a kedvenceit!";?></h1>
    </div>
    <?php
    if (isset($_SESSION["user"])) { ?>
        <div class="container">
            <?php foreach ($favourites as $f) {
                for ($i = 0; $i < count($channel_content); $i++) {
                    $line_content = explode(";;", $channel_content[$i]);
                    if ($f["channel"] == $line_content[0] && $f["loged_user"] == $_SESSION["user"]["username"] && date("l") == $line_content[1])
                        echo $line_content[2];
                }
            }?>
        </div>
        <?php
    } else {
        ;
    }
    ?>
</section>
<a href="#top"><div class="arrow bounce"></div></a>