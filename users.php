<?php
session_start();

// DB Connection
$servername = "localhost";
$username = "root";
$password = "mohan";
$dbname = "simple_chat";
$conn = new mysqli($servername, $username, $password, $dbname);

// Users in DataBase
$Users=" SELECT * FROM users ";
$rs = $conn->query($Users);
echo "<br>Users:<br>";
if ($rs->num_rows > 0) { 
	while($row = $rs->fetch_assoc()){
		if($row['uname']!=$_SESSION['LoggedUser']){
			$onlineUser = $row['uname'];
			$Path="UserFolders/".$onlineUser;
			echo "<a href=$Path target='_blank'>$onlineUser</a><br>";
		}
	}
}
?>