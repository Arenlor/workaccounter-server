<?php $pagetitle = "Stats";
require_once("header.php");
?>
<table>
<tr>
<th>Username</th>
<th>Count</th>
</tr>
<?php require_once("conn.php");
    echo "\n";
    $res = pg_query($pgconn, "SELECT username, count FROM users");
    if(!$res) {
        echo "</table>";
        echo "<p>Could not get result from server.</p>";
        require_once("footer.php");
        exit();
    }
    while($row = pg_fetch_assoc($res)) {
        echo "<tr>\n";
        echo "<td>" . $row["username"] . "</td>\n";
        echo "<td>" . $row["count"] . "</td>\n";
        echo "</tr>\n";
    }
?>
</table>
<?php require_once("footer.php");