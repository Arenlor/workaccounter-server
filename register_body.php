<?php $pagetitle = "Register";
require_once("header.php");
?>
<form action="register.php" method="POST">
<label for="username">Username (must be unqiue): </label><input type="text" id="username" name="username"><br>
<label for="password">Password: </label><input type="password" id="password" name="password"><br>
<input type="submit" value="Register">
</form>
<?php require_once("footer.php");