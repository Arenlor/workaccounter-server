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
    $insertquery = "INSERT INTO users VALUES ('" . $username . "', '" . $password . "', '" . $apikey . "', 0)";
    $res = pg_query($pgconn, $insertquery);
    if(!$res) {
        echo "Error occured in result, maybe non-unique username. Dieing.\n";
        exit();
    }
    $_SESSION["userid"] = $apikey;
    header("Location: " . $wapath . "index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php require_once("config.php"); echo($orgName); ?> - Register</title>
    </head>
    <body>
        <form action="register.php" method="POST">
            <label for="username">Username (must be unqiue): </label><input type="text" id="username" name="username"><br>
            <label for="password">Password: </label><input type="password" id="password" name="password"><br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>