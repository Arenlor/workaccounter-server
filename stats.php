<?php require_once("config.php"); ?>
<!DOCTYPE html>
<html lang="en=US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo($orgName); ?> - Stats</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Username</th>
                <th>Count</th>
            </tr><?php require_once("conn.php");
            echo "\n";
            $res = pg_query($pgconn, "SELECT username, count FROM users");
            if(!$res) {
                echo "Error in result. Dieing. \n";
                exit();
            }
            while($row = pg_fetch_assoc($res)) {
                echo "            <tr>\n";
                echo "                <td>" . $row["username"] . "</td>\n";
                echo "                <td>" . $row["count"] . "</td>\n";
                echo "            </tr>\n";
            }
            ?>
        </table>
    </body>
</html>