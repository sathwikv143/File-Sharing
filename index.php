<?php
session_start();
if (isset($_SESSION['LoggedUser'])) {
	// redirection to Home Page
	header('HTTP/1.1 307 Temporary Redirect');
	header('Location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width: device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.min.css">
	<style type="text/css">
	.container{
		padding-top: 20%;
		max-width: 450px;
	}
</style>
</head>
<body>
	<center>
		<form method="POST" class="container" action="login.php">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Name:</span>
				</div>
				<input type="text" class="form-control" required placeholder="username" aria-describedby="basic-addon2" name="uname">
				<div class="input-group-append">
					<button type="submit" class="btn btn-secondary" name="submit">Login</button>
				</div>
			</div>
		</form>
	</center>
</body>
</html>