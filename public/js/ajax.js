
function logout() {
    $.ajax({
        type : "POST",
        url : "logout",
        success: function(response) {
            if (response) {
                $.notify("Sikeres kijelentkezés!","success");
            } else {
                $.notify("Hiba lépett fel a kijelentkezés során!","error");
            }
            setTimeout(function(){
                window.location.href = window.location.href;
            }, 1000);
        },
        error: function () {
            $.notify("Nem sikerült kapcsolatot létesíteni a szerverrel!","error");
        }
    });
}

function add_to_fav(id) {
    $.ajax({
        type : "POST",
        data : {
            "channel_id": id
        },
        url : " http://localhost/mvc/add-to-fav",
        success: function(response) {
            console.log(response);
            if (response == 1) {
                $.notify("Sikeresen hozzáadta a kedvencekhez!","success");
            } else if(response == 0) {
                $.notify("Ez a csatorna már szerepel a kedvenceid között!","warn");
            } else {
                $.notify("Hiba lépett fel!","error");
            }
        },
        error: function () {
            $.notify("Nem sikerült kapcsolatot létesíteni a szerverrel!","error");
        }
    });
}