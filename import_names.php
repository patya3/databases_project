<?php

$con = mysqli_connect("localhost","root","","tv_guide");
$names = array();

$sql = "SELECT id FROM actors";
$result = mysqli_query($con, $sql, MYSQLI_USE_RESULT);
while ($row = mysqli_fetch_assoc($result)) {
    $names[] = $row["id"];
}
$show_ids = array();
$sql2 = "SELECT id FROM shows";
$result2 = mysqli_query($con, $sql2, MYSQLI_USE_RESULT);
while ($row = mysqli_fetch_assoc($result2)) {
    $show_ids[] =  $row["id"];
}
foreach ($show_ids as $id) {
    $rand1 = rand(1, 98);
    $rand2 = rand(1,98);
    if ($rand1 != $rand2) {
        $actor_ids = $rand1.",".$rand2;
        $sql_update = "UPDATE shows SET actor_ids = '$actor_ids' WHERE id = '".$id."'";
        mysqli_query($con, $sql_update);
    }
}

$file = fopen("names.txt", "r");

/*while (($row = fgets($file)) !== false) {
    $row = str_replace("\r","",$row);
    $row = str_replace("\n","",$row);
    $sql = "INSERT INTO actors (actor_name) values ('$row')";
    mysqli_query($con, $sql);
}*/

