<?php session_name("workaccounter");
session_start();
if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"])) {
    require_once("config.php");
    header("Location: " . $wapath . "index.php");
    exit();
}
elseif((isset($_POST["username"]) && !empty($_POST["username"])) && (isset($_POST["password"]) && !empty($_POST["password"]))) {
    $password = $_POST["password"];
    require_once("config.php");
    for($i=0;$i<$iterations;$i++) {
        $password = hash($hash, $password . $salt);
    }
    $username = pg_escape_string($_POST["username"]);
    require_once("conn.php");
    $selectquery = "SELECT apikey FROM users WHERE username = '" . $username . "' AND password = '" . $password . "'";
    $res = pg_query($pgconn, $selectquery);
    if(!$res) {
        $pagetitle = "Login";
        require_once("header.php");
        echo "<p>Could not get result from server.</p>";
        require_once("footer.php");
        exit();
    }
    else {
        $apikey = pg_fetch_row($res);
        $_SESSION["userid"] = $apikey[0];
        header("Location: " . $wapath . "index.php");
        exit();
    }
}
require("login_body.php");
?>