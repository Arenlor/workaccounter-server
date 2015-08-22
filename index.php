<?php session_name("workaccounter");
session_start();
$pagetitle = "Work Accounter";
require_once("header.php");
?>
<h1>Work Accounter</h1>
<p>Welcome to my Work Accounter site. You can <a href="register.php">register</a> or <a href="login.php">login</a> if you already have an account. You can also check out the <a href="stats.php">stats</a>.</p>
<h2>Purpose</h2>
<p>The purpose is to keep you accountable to working, instead of browsing the web. This server uses the <a href="https://addons.mozilla.org/en-US/firefox/addon/work-accounter/">Work Accounter Add-on</a>.<p>
<p>You can use <span style="font-size:smaller;"><?php echo($wapath . "submit.php"); ?></span> as your Stats URL. If you're logged in your can find your API Key below.</p>
<?php if(isset($_SESSION["userid"]) && !empty($_SESSION["userid"])) {
    echo "<p>Your API Key is: " . $_SESSION["userid"] . "</p>";
    echo "<p>You can reset your API Key <a href=\"reset.php\">here</a>.</p>";
} ?>
<?php require_once("footer.php");