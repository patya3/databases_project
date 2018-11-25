<div class="container">
    <!--műsor módosítása-->
    <div class="container-login" style="float: left; margin-right: 10px; height: 60%;">
        <h1 style="padding-top: 20px;">Műsor módosítása</h1>
        <?php if (isset($this->update_errors) && count($this->update_errors) != 0) {
            $string = "<div class='alert alert-danger'><ul>";
            foreach ($this->update_errors as $error) {
                $string .= "<li>" . $error . "</li>";
            }
            $string .= "</ul></div>";
            echo $string;
        }
        if (isset($this->update_message)) {
            echo "<div class='alert alert-success'>".$this->update_message . "</div>";
        }
        ?>
        <form action="admin" id="addBook" method="post">
            <div class="row-input">
                <select name="id" id="select_show">
                    <?php
                    foreach ($this->shows as $show) {
                        echo "<option data-show-name='".$show["show_name"]."' data-channel-id='".$show["channel_id"]."' data-show-category-id='".$show["show_category_id"]."' data-start-date='".$show["start_date"]."' data-end-date='".$show["end_date"]."' value='" . $show["id"] . "' data-actors='".$show["actor_ids"]."'>" .$show["start_date"]." ".$show["show_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <input type="text" name="show_name" id="modify_show_name" placeholder="Műsor neve">
            </div>
            <div class="row-input">
                <select name="channel_id" id="select_channel_id">
                    <?php
                    foreach ($this->channels as $channel) {
                        echo "<option value='".$channel["id"]."'>".$channel["channel_name"]."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <select class="row-input" name="show_category_id" id="select_show_category_id">
                    <?php
                    foreach ($this->show_categories as $category) {
                        echo "<option value='" . $category["id"] . "'>" . $category["show_category_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <label for="select_actor_ids">Szereplők</label><br>
                <select class="row-input" name="actor_ids[]" id="select_actor_ids" multiple style="height: 200px">
                    <?php
                    foreach ($this->actors as $actor) {
                        echo "<option value='" . $actor["id"] . "'>" . $actor["actor_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <input type="datetime-local" name="start_date" id="modify_start_date">
            </div>
            <div class="row-input">
                <input type="datetime-local" name="end_date" id="modify_end_date">
            </div>
            <input type="submit" name="update_show" value="Műsor módosítása" class="login-button">
        </form>
    </div>
    <!--műsor hozzáadása-->
    <div class="container-login" style="float: left; margin-right: 10px">
        <h1 style="padding-top: 20px;">Műsor hozzáadása</h1>
        <?php if (isset($this->add_errors) && count($this->add_errors) != 0) {
            $string = "<div class='alert alert-danger'><ul>";
            foreach ($this->add_errors as $error) {
                $string .= "<li>" . $error . "</li>";
            }
            $string .= "</ul></div>";
            echo $string;
        }
        if (isset($this->add_message)) {
            echo "<div class='alert alert-success'>".$this->add_message . "</div>";
        }
        ?>
        <form action="admin" id="addBook" method="post">
            <div class="row-input">
                <input type="text" name="show_name" placeholder="Műsor neve" maxlength="255">
            </div>
            <div class="row-input">
                <label for="channel_id">Csatorna</label><br>
                <select name="channel_id" id="channel_id">
                    <?php
                    foreach ($this->channels as $channel) {
                        echo "<option value='" . $channel["id"] . "'>" . $channel["channel_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <label for="show_category_id">Műsor kategória</label><br>
                <select class="row-input" name="show_category_id" id="show_category_id">
                    <?php
                    foreach ($this->show_categories as $category) {
                        echo "<option value='" . $category["id"] . "'>" . $category["show_category_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <label for="actor_ids">Műsor kategória</label><br>
                <select class="row-input" name="actor_ids[]" id="actor_ids" multiple style="height: 200px">
                    <?php
                    foreach ($this->actors as $actor) {
                        echo "<option value='" . $actor["id"] . "'>" . $actor["actor_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row-input">
                <label for="start_date">Kezdés időpontja</label><br>
                <input type="datetime-local" name="start_date" id="start_date">
            </div>
            <div class="row-input">
                <label for="end_date">Befejezés időpontja</label><br>
                <input type="datetime-local" name="end_date" id="end_date">
            </div>
            <input type="submit" name="add_show" value="Műsor hozzáadása" class="login-button">
        </form>
    </div>

    <!--műsor törlése-->
    <div class="container-login" style="float: left;">
        <h1 style="padding-top: 20px;">Műsor törlése</h1>
        <?php if (isset($this->delete_message)) echo "<div class='alert alert-success'>".$this->delete_message."</div>"?>
        <form action="admin" id="addBook" method="post">
            <div class="row-input">
                <label for="channel_id">Csatorna</label><br>
                <select name="id" id="id">
                    <?php
                    foreach ($this->shows as $show) {
                        echo "<option value='" . $show["id"] . "'>" .$show["start_date"]." ".$show["show_name"] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" name="delete_show" value="Műsor törlése" class="login-button">
        </form>
    </div>
</div>
<script>
    $("#select_show").change(function () {
        $("#select_show_category_id").val($(this).find(":selected").data("show-category-id"));
        $("#select_channel_id").val($(this).find(":selected").data("channel-id"));
        var startDate = $(this).find(":selected").data("start-date").replace(/\ /g, 'T');
        var endDate = $(this).find(":selected").data("end-date").replace(/\ /g, 'T');
        console.log(startDate);
        $("#modify_start_date").val(startDate);
        $("#modify_end_date").val(endDate);
        $("#modify_show_name").val($(this).find(":selected").data("show-name"));
        var actor_ids = $(this).find(":selected").data("actors");
        $.each(actor_ids.split(","), function (i,e) {
           $("#select_actor_ids option[value='"+e+"']").prop("selected", true);
        });
        console.log($("#select_actor_ids"));
    });
</script>