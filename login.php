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
        echo "Error occured in result. Dieing.\n";
        exit();
    }
    elseif(pg_num_rows($res) != 1) {
        echo "Error occured, not found. Dieing.\n";
        exit();
    }
    else {
        $apikey = pg_fetch_row($res);
        $_SESSION["userid"] = $apikey[0];
        header("Location: " . $wapath . "index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php require_once("config.php"); echo($orgName); ?> - Login</title>
    </head>
    <body>
        <form action="login.php" method="POST">
            <label for="username">Username: </label><input type="text" name="username" id="username"><br>
            <label for="password">Password: </label><input type="password" name="password" id="password"><br>
            <input type="submit" value="login">
        </form>
    </body>
</html>