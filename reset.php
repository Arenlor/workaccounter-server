<?php session_name("workaccounter");
session_start();
if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"])) {
    require_once("config.php");
    require_once("conn.php");
    $selectquery = "SELECT username,password FROM users WHERE apikey = '" . pg_escape_string($_SESSION["userid"]) . "'";
    $res = pg_query($pgconn, $selectquery);
    if(!$res) {
        $pagetitle = "API Key Reset";
        require_once("header.php");
        echo "<p>Could not get result from server.</p>";
        require_once("footer.php");
        exit();
    }
    elseif(pg_num_rows($res) != 1) {
        $pagetitle = "API Key Reset";
        require_once("header.php");
        echo "<p>Could not locate you. Contact <a href=\"mailto:workaccounter@arenlor.com\">Support</a></p>";
        require_once("footer.php");
        exit();
    }
    else {
        $row = pg_fetch_assoc($res);
        $apikey = hash($hash, $salt . $row["password"] . $row["username"] . time());
        $updatequery = "UPDATE users SET apikey = '" . $apikey . "' WHERE username = '" . $row["username"] . "'";
        $res = pg_query($pgconn, $updatequery);
        if(!$res) {
            $pagetitle = "API Key Reset";
            require_once("header.php");
            echo "<p>Could not get result from server.</p>";
            require_once("footer.php");
            exit();
        }
        else {
            unset($_SESSION["userid"]);
            header("Location: " . $wapath . "login.php");
            exit();
        }
    }
}
else {
    require_once("config.php");
    header("Location: " . $wapath . "index.php");
    exit();
}
?>