<?php
session_start();

// DB Connection
$server = 'localhost';
$username = 'root';
$password = 'mohan';
$database = 'simple_chat';
$connect = new mysqli($server, $username, $password, $database);

// Username from Login session
$User = $_SESSION['LoggedUser'];

// deleting user details from DB after logout
$Delete = $connect->prepare("DELETE FROM users WHERE uname=?");
$Delete->bind_param("s",$User);
$Delete->execute();

function delete_directory($dirname) {
	if (is_dir($dirname))
		$dir_handle = opendir($dirname);
	if (!$dir_handle)
		return false;
	while($file = readdir($dir_handle)) {
		if ($file != "." && $file != "..") {
			if (!is_dir($dirname."/".$file))
				unlink($dirname."/".$file);
			else
				delete_directory($dirname.'/'.$file);
		}
	}
closedir($dir_handle);
rmdir($dirname);
return true;
}
$path = "UserFolders/".$User;
delete_directory($path);

session_destroy();

// redirection to Home Page
header('HTTP/1.1 307 Temporary Redirect');
header('Location:index.php');

?>