<?php if((isset($_GET["apikey"]) && !empty($_GET["apikey"])) && (isset($_GET["count"]) && (!empty($_GET["count"]) || $_GET["count"] == 0))) {
    $count = pg_escape_string($_GET["count"]);
    $apikey = pg_escape_string($_GET["apikey"]);
    require_once("conn.php");
    $updatequery = "UPDATE users SET count=" . $count . " WHERE apikey='" . $apikey . "'";
    pg_query($pgconn, $updatequery);
}
else {
    require_once("config.php");
    header("Location: " . $wapath . "index.php");
    exit();
}
?>