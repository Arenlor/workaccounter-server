<?php $pgconn = pg_connect("host=localhost port=5432 dbname=workaccounter user=root password=password");
if(!$pgconn) {
    echo("Error connecting to the DB. Dieing.");
    exit();
}
/* set above to the correct settings */
?>