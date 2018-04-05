<?php
session_start();
$LoggedDir = explode('/',getcwd());
$Name = $LoggedDir[count($LoggedDir)-1];
if ($Name == $_SESSION['LoggedUser']) {
	header("location:NewFileManager.php");
}
else {
	$dir = opendir('.');
	while (($entry = readdir($dir)) != FALSE) {
		if ($entry != '.' && $entry != '..' && $entry != 'index.php' && $entry!='NewFileManager.php') {
			echo "<a href=$entry target='_blank'>$entry</a><br>";
		}
	}
}
?>
<form action="../../login.php">
	<button type="submit">BACK</button>
</form>