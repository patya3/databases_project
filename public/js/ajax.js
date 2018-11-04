
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