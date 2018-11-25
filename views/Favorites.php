    <div class="container">
    <div class="container-login" style="float: left">
        <h1 style="padding-top: 10px">Kedvencek</h1>
        <table>
            <tr>
            <?php
            foreach ($this->favorites as $cat => $fav) {
                echo "<th width='33.3%'>".$cat."</th>";
            }
            ?>
            </tr>
            <?php
            $max = max(count($this->favorites["comedy"]), count($this->favorites["nature"]), count($this->favorites["sport"]));
                $string = "";
                for ($j = 0; $j < $max; $j++) {
                        $string .= "<tr>";
                        $string .= isset($this->favorites["comedy"][$j]) ? "<td>".$this->favorites["comedy"][$j]."</td>" : "<td></td>";
                        $string .= isset($this->favorites["nature"][$j]) ? "<td>".$this->favorites["nature"][$j]."</td>" : "<td></td>";
                        $string .= isset($this->favorites["sport"][$j]) ? "<td>".$this->favorites["sport"][$j]."</td>" : "<td></td>";
                        $string .= "</tr>";
                }
                echo $string;
            ?>
        </table>
        <br>
        <a href="<?php echo public_url() ?>">Ugrás a főoldalra</a>
    </div>
    <div class="container-login" style="float: right">
        <h1 style="padding-top: 10px">Napi érdekesség</h1>
        <h5>A követett csatornáid között hány darab van az adott műsorkategóriákból</h5>
        <table>
            <?php foreach ($this->statistics as $row) {
                echo "<tr><td>".$row["show_category_name"]."</td><td>".$row["amount"]."</td></tr>";
            }?>
        </table>
    </div>
    </div>