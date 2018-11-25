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
            $content .= '<a href="' . public_url('/category/' . $cat["page"] . '-' . $cat["id"]) . '"><img src="' . public_url($cat["logo"]) . '" alt="' . $key . '"></a>';
            $content .= '<a href="category/' . $cat["page"] . '-' . $cat["id"] . '"><h3>' . $key . '</h3></a>';
            $content .= '<p>';
            if (!empty($cat["channels"])) {
                for ($i = 0; $i < count($cat["channels"]); $i++) {
                    $delimiter = $i == count($cat["channels"]) - 1 ? "" : ", ";
                    $content .= $cat["channels"][$i]["channel_name"] . $delimiter;
                }
            }
            $content .= '</p>';
            $content .= '</div>';
            echo $content;
        endforeach; ?>
    </div>
</section>
<section id="favourites">
    <div class="container">
        <h1><?php if (isset($_SESSION["user"])) echo "Lentebb láthatja kedvenc csatornái aktuális műsorát!"; else echo "Jelentkezzen be, hogy láthassa a kedvenceit!"; ?></h1>
    </div>
    <?php
    if (isset($_SESSION["user"])) {
        echo "<div class='container'>";
        if (count($this->favorites) > 0) {
            foreach ($this->favorites as $id => $channel) {
                $box_string = "<div class='box'>" .
                    "<a href='" . public_url("/category/".$channel["url"]."#".$id) . "'><img src='" . public_url($channel["c_logo"]) . "' alt='" . $channel["c_name"] . "'></a>" .
                    "<a href='" . public_url("/category/".$channel["url"]."#".$id) . "'><h3>" . $channel["c_name"] . "</h3></a>";

                $box_string .= "<table><tbody>";
                foreach ($channel["shows"] as $show) {
                    $box_string .= "<tr><td>" . $show["time"] . " " . $show["name"] . "</td></tr>";
                }
                $box_string .= "</tbody></table></div>";
                echo $box_string;
            }
        }
        echo "</div>";
    }
    ?>
</section>
<a href="#top">
    <div class="arrow bounce"></div>
</a>