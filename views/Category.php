
<?php
$modal_ready = "";
$modal_name = "";
$modal_start_date = "";
foreach ($this->shows as $key => $channel): ?>
    <div id="ex<?php echo $key; ?>" class="modal">
        <h1><?php echo $channel["name"]; ?> műsorlista</h1>
        <p>
        <table>
            <tr>
                <th>Hétfő</th>
                <th>Kedd</th>
                <th>Szerda</th>
                <th>Csütörtök</th>
                <th>Péntek</th>
            </tr>
            <?php
            $monday = [];$tuesday = [];$wednesday = [];$thursday = [];$friday = [];/*$saturday = [];$sunday = [];*/
            $k = 0;
            foreach ($channel["shows"] as $show) {
                $timestamp = strtotime($show["start_date"]);
                $show_day = date('l', $timestamp);
                $show_time = date("H:i", $timestamp);
                if ($show_day == "Monday") {
                    $monday[] = array(
                        "string" => $show_time . " " . $show["show_name"],
                        "data" => $monday["data"] = $show
                    );
                } elseif ($show_day == "Tuesday") {
                    $tuesday[] = array(
                        "string" => $show_time . " " . $show["show_name"],
                        "data" => $tuesday["data"] = $show
                    );
                } elseif ($show_day == "Wednesday") {
                    $wednesday[] = array(
                        "string" => $show_time . " " . $show["show_name"],
                        "data" => $wednesday["data"] = $show
                    );
                } elseif ($show_day == "Thursday") {
                    $thursday[] = array(
                        "string" => $show_time . " " . $show["show_name"],
                        "data" => $thursday["data"] = $show
                    );
                } elseif ($show_day == "Friday") {
                    $friday[] = array(
                        "string" => $show_time . " " . $show["show_name"],
                        "data" => $friday["data"] = $show
                    );
                } /*elseif ($show_day == "Saturday") {
                    $saturday[] = $show_time . " " . $show["show_name"];
                } elseif ($show_day == "Sunday") {
                    $sunday[] = $show_time . " " . $show["show_name"];
                }*/
            }
            $length = max(count($monday), count($tuesday), count($wednesday), count($thursday), count($friday) /*count($saturday), count($sunday)*/);
            $string = "";
            for ($i = 0; $i < $length; $i++) {
                $string .= "<tr>";
                if (array_key_exists($i, $monday)) {
                    $data = $monday[$i]["data"];
                    $string .= "<td id='".$i."' data-name='".$data["show_name"]."' data-start-date='".$data["start_date"]."' data-end-date='".$data["end_date"]."' data-category='".$data["show_category_name"]."' data-channel='".$channel["name"]."'><a href=\"#m1\" rel=\"modal:open\">" . $monday[$i]["string"] . "</a></td>";
                }
                else $string .= "<td></td>";
                if (array_key_exists($i, $tuesday)) {
                    $data = $tuesday[$i]["data"];
                    $string .= "<td id='".$i."' data-name='".$data["show_name"]."' data-start-date='".$data["start_date"]."' data-end-date='".$data["end_date"]."' data-category='".$data["show_category_name"]."' data-channel='".$channel["name"]."'><a href=\"#m1\" rel=\"modal:open\">" . $tuesday[$i]["string"] . "</a></td>";
                }
                else $string .= "<td></td>";
                if (array_key_exists($i, $wednesday)) {
                    $data = $wednesday[$i]["data"];
                    $string .= "<td id='".$i."' data-name='".$data["show_name"]."' data-start-date='".$data["start_date"]."' data-end-date='".$data["end_date"]."' data-category='".$data["show_category_name"]."' data-channel='".$channel["name"]."'><a href=\"#m1\" rel=\"modal:open\">" . $wednesday[$i]["string"] . "</a></td>";
                }
                else $string .= "<td></td>";
                if (array_key_exists($i, $thursday)) {
                    $data = $thursday[$i]["data"];
                    $string .= "<td id='".$i."' data-name='".$data["show_name"]."' data-start-date='".$data["start_date"]."' data-end-date='".$data["end_date"]."' data-category='".$data["show_category_name"]."' data-channel='".$channel["name"]."'><a href=\"#m1\" rel=\"modal:open\">" . $thursday[$i]["string"] . "</a></td>";
                }
                else $string .= "<td></td>";
                if (array_key_exists($i, $friday)) {
                    $data = $friday[$i]["data"];
                    $string .= "<td id='".$i."' data-name='".$data["show_name"]."' data-start-date='".$data["start_date"]."' data-end-date='".$data["end_date"]."' data-category='".$data["show_category_name"]."' data-channel='".$channel["name"]."'><a href=\"#m1\" rel=\"modal:open\">" . $friday[$i]["string"] . "</a></td>";
                }
                else $string .= "<td></td>";
                /*if (array_key_exists($i, $saturday)) $string .= "<td>" . $saturday[$i] . "</td>";
                else $string .= "<td></td>";
                if (array_key_exists($i, $sunday)) $string .= "<td>" . $sunday[$i] . "</td>";
                else $string .= "<td></td>";
                $string .= "</tr>";*/
            }
            echo $string; ?>

        </table>
        </p>
        <a href="#" rel="modal:close">Bezárás</a>
    </div>
<?php endforeach; ?>
<div id="m1" class="modal">

    <a href="#" rel="modal:close">Close</a>
</div>

<a id="top"></a>
<section><!--class="nature"-->
    <div class="video_div">
        <video autoplay muted loop>
            <source src="img/comedy_video.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    </div>
</section>
<div class="container category">Itt megtalálja a legnépszerűbb szorakoztató csatornákat, mint az RTL Klub és nagy
    riválisa a TV2, valamint többek között a legnagyobb "humorgyárat" is, a Comedy Central-t. Ezen csatornák mindegyike
    folyamatosan szolgáltatja a jobbnál jobb, újabb műsorokat, de megtalálhatók a klasszikus/közönségkedvencek is, mint
    a South Park, Éjjel-Nappal Budapest vagy akár a Jóban Roszban.
</div>
<div class="channel_boxes">
    <div class="container">
        <?php foreach ($this->channels as $channel): ?>
            <div class="box">
                <a href="#<?php echo $channel["id"] ?>"><img src="<?php echo public_url($channel["channel_logo"]) ?>"
                                                             alt="<?php echo $channel["channel_name"] ?>"></a>
                <a href="#<?php echo $channel["id"] ?>"><h3><?php $channel["channel_name"] ?></h3></a>
                <p><?php echo $channel["short_description"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php foreach ($this->channels as $channel): ?>
    <div id="<?php echo $channel["id"] ?>" class="container grey-bg" style="width: 60%; padding: 6px 0 0 6px;">
        <div class="box" style="width: unset">
            <a href="#"><img src="<?php echo public_url($channel["channel_logo"]) ?>"
                                                         alt="<?php echo $channel["channel_name"] ?>"></a>
        </div>
        <div class="description">
            <h2>Csatorna neve: <span><?php echo $channel["channel_name"] ?></span></h2>
            <p>Műsorok:
                <?php
                $example_shows = array();
                foreach ($this->shows[$channel["id"]]["shows"] as $show) {
                    if (!in_array($show["show_name"], $example_shows)) {
                        $example_shows[] = $show["show_name"];
                    }
                    if (count($example_shows) == 5)
                        break;
                }
                $string = "";
                for ($i = 0; $i < count($example_shows); $i++) {
                    $join = ($i == count($example_shows) - 1) ? "" : ", ";
                    $string .= $example_shows[$i] . $join;
                }
                echo $string . " ...";
                ?>
                <br>
            </p>
            <p>Kategóriák:
                <?php
                $string = "";
                for ($i = 0; $i < count($this->cats[$channel["id"]]); $i++) {
                    $join = ($i == count($this->cats[$channel["id"]]) - 1) ? "" : ", ";
                    $string .= $this->cats[$channel["id"]][$i]["show_category_name"] . $join;
                }
                echo $string . " ...";
                ?>
                <br>
            </p>
            <p>Leírás: <?php echo $channel["short_description"] ?><br></p>

            <a href="#ex<?php echo $channel["id"] ?>" rel="modal:open">
                <button>Heti műsor megtekintése</button>
            </a>
            <?php if (isset($_SESSION["user"])): ?>
                <button onclick="add_to_fav(<?php echo $channel["id"]; ?>)">hozzáadás a kedvencekhez</button>
            <?php else: ?>
                <p style="color: coral">Jelentkezzen be, hogy hozzáadhassa kedvenceihez.</p>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $('a[href="#m1"]').click(function(event) {
        event.preventDefault();
        $(this).modal({
            closeExisting: false
        });
        console.log($(this).parent().data("name"));
        $("#m1").css("width","unset");
        $("#m1").html("");
        $("#m1").prepend(
            "<p>Csatorna neve: "+$(this).parent().data("channel")+"</p>" +
            "<p>Műsor neve: "+$(this).parent().data("name")+"</p>" +
            "<p>Műsor kezdete: "+$(this).parent().data("start-date")+"</p>" +
            "<p>Műsor vége: "+$(this).parent().data("end-date")+"</p>" +
            "<p>Kategoria: "+$(this).parent().data("category")+
            "<p>Szereplők: </p>"
        );
    });
</script>