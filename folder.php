<?php
session_start();

$FolderName = $_SESSION['LoggedUser'];
$path = "UserFolders/";
mkdir($path.$FolderName,0777);

if (file_exists($path.$FolderName)) {
	copy("filemanager.php",$path.$FolderName."/index.php");
	copy("NewFileManager.php",$path.$FolderName."/NewFileManager.php");
}

$FullPath = $path.$FolderName."/";
echo "<br><a href=$FullPath target='_blank'>MyFiles</a>";
?>
