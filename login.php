<?php
// Session
session_start();

// DB Connection
$server = 'localhost';
$username = 'root';
$password = 'mohan';
$database = 'simple_chat';
$connect = new mysqli($server, $username, $password, $database);

// Username from index.html
if($_SERVER['REQUEST_METHOD']=='POST'){
    $User = htmlspecialchars($_POST['uname'],ENT_QUOTES,"UTF-8");
}

// IP Check in Database
$checkIp = $connect->prepare("SELECT ipAddr from users where uname=?");
$checkIp->bind_param("s",$User);
$checkIp->execute();
$checkIp->bind_result($ValidIp);

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    if(isset($_SESSION["LoggedUser"])){
        if($_SESSION["LoggedUser"] == $User){
            echo "Welcome $User <br>";
            echo "Logged in <br>";
            include 'folder.php';
            include 'users.php';
            echo "<a href='logout.php'>Logout</a>";
        }
        else{
            $x = $_SESSION['LoggedUser'];
            echo "Welcome $x <br>";
            echo "Logged in <br>";
            include 'folder.php';
            include 'users.php';
            echo "<a href='logout.php'>Logout</a>";
        }
    }
    else{
        if($checkIp->fetch()){
            echo "User another username";
            echo "<a href='index.php'>BACK</a>";
        }
        $ip = getIp();
        $insertDetails = $connect->prepare("INSERT INTO users VALUES ('$User','$ip') ");
        $insertDetails->bind_param("ss",$User,$ip);
        $insertDetails->execute();
        echo "Welcome $User <br>";
        echo "Logged in <br>";
        $_SESSION['LoggedUser'] = $User;
        include 'folder.php';
        include 'users.php';
        echo "<a href='logout.php'>Logout</a>";
    }
}

// Function to get Real IP of the user
function getIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$connect->close();
?>