<?php $pgconn = pg_connect("host=localhost port=5432 dbname=workaccounter user=root password=password");
if(!$pgconn) {
    require_once("header.php");
    echo("<p>Error connecting to the DB.</p>");
    require_once("footer.php");
    exit();
}
/* set above to the correct settings */
?>