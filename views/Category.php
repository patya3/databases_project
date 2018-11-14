<!-- <div id="ex1" class="modal">
    <p>Thanks for clicking. That felt good.</p>
    <a href="#" rel="modal:close">Close</a>
</div>

Link to open the modal
<p><a href="#ex1" rel="modal:open">Open Modal</a></p>-->
<a id="top"></a>
<section><!--class="nature"-->
    <div class="video_div">
        <video autoplay muted loop>
            <source src="img/comedy_video.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
    </div>
</section>
<div class="container category">Itt megtalálja a legnépszerűbb szorakoztató csatornákat, mint az RTL Klub és nagy riválisa a TV2, valamint többek között a legnagyobb "humorgyárat" is, a Comedy Central-t. Ezen csatornák mindegyike folyamatosan szolgáltatja a jobbnál jobb, újabb műsorokat, de megtalálhatók a klasszikus/közönségkedvencek is, mint a South Park, Éjjel-Nappal Budapest vagy akár a Jóban Roszban.</div>
<div class="channel_boxes">
    <div class="container">
        <?php foreach ($this->channels as $channel):?>
            <div class="box">
                <a href="#<?php echo $channel["id"]?>"><img src="<?php echo public_url($channel["channel_logo"])?>" alt="<?php echo $channel["channel_name"]?>"></a>
                <a href="#<?php echo $channel["id"]?>"><h3><?php $channel["channel_name"]?></h3></a>
                <p><?php echo $channel["short_description"]?></p>
            </div>
        <?php endforeach;?>
    </div>
</div>
<?php foreach ($this->channels as $channel):?>
    <div class="container grey-bg" style="width: 60%; padding: 6px 0 0 6px;">
        <div class="box" style="width: 0">
            <a href="#<?php echo $channel["id"]?>"><img src="<?php echo public_url($channel["channel_logo"])?>" alt="<?php echo $channel["channel_name"]?>"></a>
        </div>
        <div class="description">
            <h2>Csatorna neve: <span><?php echo $channel["channel_name"]?></span></h2>
            <p>Műsorok:
                <?php
                    $example_shows = array();
                    foreach ($this->shows[$channel["id"]]["shows"] as $show) {
                        if (!in_array($show["show_name"],$example_shows)) {
                            $example_shows[] = $show["show_name"];
                        }
                        if (count($example_shows) == 5)
                            break;
                    }
                    $string = "";
                    for ($i = 0; $i < count($example_shows); $i++) {
                        $join = ($i == count($example_shows)-1) ? "" : ", ";
                        $string .= $example_shows[$i].$join;
                    }
                    echo $string." ...";
                ?>
            <br>
            </p>
            <p>Kategóriák:
                <?php
                    $string = "";
                    for ($i = 0; $i < count($this->cats[$channel["id"]]); $i++) {
                        $join = ($i == count($this->cats[$channel["id"]])-1) ? "" : ", ";
                        $string .= $this->cats[$channel["id"]][$i]["show_category_name"].$join;
                    }
                    echo $string." ...";
                 ?>
                <br>
            </p>
            <p>Leírás: <?php echo $channel["short_description"]?><br></p>
            <button>Heti műsor megtekintése</button>
            <?php if (isset($_SESSION["user"])):?>
                <button onclick="add_to_fav(<?php echo $channel["id"];?>)">hozzáadás a kedvencekhez</button>
            <?php else:?>
                <p>Jelentkezzen be, hogy hozzáadhassa kedvenceihez.</p>
            <?php endif;?>
        </div>
    </div>
<?php endforeach;?>
