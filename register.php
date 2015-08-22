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
    $apikey = hash($hash, $salt . $password . $username . time());
    require_once("conn.php");
    $selectquery = "SELECT ALL FROM users WHERE username = '" . $username . "'";
    $res = pg_query($pgconn, $selectquery);
    if(!$res) {
        $pagetitle = "Register";
        require_once("header.php");
        echo "<p>Could not get result from server.</p>";
        require_once("footer.php");
        exit();
    }
    if(pg_num_rows($res) > 0) {
        require_once("register_body.php");
        exit();
    }
    $insertquery = "INSERT INTO users VALUES ('" . $username . "', '" . $password . "', '" . $apikey . "', 0)";
    $res = pg_query($pgconn, $insertquery);
    if(!$res) {
        $pagetitle = "Register";
        require_once("header.php");
        echo "<p>Could not get result from server.</p>";
        require_once("footer.php");
        exit();
    }
    $_SESSION["userid"] = $apikey;
    header("Location: " . $wapath . "index.php");
    exit();
}
require_once("register_body.php");
?>