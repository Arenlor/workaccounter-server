<?php $pagetitle = "Login";
require_once("header.php");
?>
<form action="login.php" method="POST">
<label for="username">Username: </label><input type="text" name="username" id="username"><br>
<label for="password">Password: </label><input type="password" name="password" id="password"><br>
<input type="submit" value="login">
</form>
<?php require_once("footer.php");