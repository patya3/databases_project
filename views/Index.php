
<a id="top"></a>
<section id="showcase">
    <div class="container">
        <h1>Tv-s műsorújság</h1>
        <p>Üdvözöllek az oldalon, remélem megtalálod azt a műsort, amit keresel!</p>
    </div>
</section>
<section id="boxes">
    <div class="container">
        <?php foreach ($this->data as $key => $cat):
            $content = '<div class="box">';
                $content .= '<a href="category/'.$cat["page"].'-'.$cat["id"].'"><img src="'.$cat["logo"].'" alt="'.$key.'"></a>';
                $content .= '<a href="category/'.$cat["page"].'-'.$cat["id"].'"><h3>'.$key.'</h3></a>';
                $content .= '<p>';
                if (!empty($cat["channels"])) {
                    for ($i = 0; $i < count($cat["channels"]); $i++) {
                        $delimiter = $i == count($cat["channels"])-1 ? "" : ", ";
                        $content .= $cat["channels"][$i]["channel_name"].$delimiter;
                    }
                }
                $content .= '</p>';
            $content .='</div>';
            echo $content;
        endforeach;?>
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