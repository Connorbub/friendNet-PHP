<?php 
include("./inc/connect.inc.php") ;
session_start();
if(!isset($_SESSION["user_login"])) {
	$user = "";
} else {
	$user = $_SESSION["user_login"];
}

$get_unread_query = mysqli_query($connect,"SELECT opened FROM  pvt_messages WHERE user_to='$user' && opened='no'");
$unread_numrows = mysqli_num_rows($get_unread_query);

$get_requests_query = mysqli_query($connect,"SELECT id FROM friend_requests WHERE user_to='$user'");
$requests_numrows = mysqli_num_rows($get_requests_query);

$get_pokes_query = mysqli_query($connect,"SELECT id FROM pokes WHERE user_to='$user'");
$pokes_numrows = mysqli_num_rows($get_pokes_query);

?>
<!doctype html>
<html>
	<head>
		<title>friendNet</title>
		<link rel="icon" type="image/ico" href="./img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<script src="js/main.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class='headerMenu'>
			<div id="wrapper">
				<?php if(!$user) {
					echo '<div class="logo">
						<a href="index.php"><img src="./img/friendNetLogo.png" /></a>
					</div>';
				} else {
				echo '<div class="logo">
					<a href="home.php"><img src="./img/friendNetLogo.png" /></a>
				</div>';
				}
				?>
				<div class="search_box">
					<form action="search.php" method="GET" id="search">
						<input type="text" name="q" size="60" placeholder="Search...">
					</form>
				</div>
				<?php
				if(!$user) {
				echo '<div id="menu">
					<a href="http://localhost/friendNet/" />Home</a>
					<a href="./about.php" />About</a>
					<a href="http://localhost/friendNet/" />Sign Up</a>
					<a href="http://localhost/friendNet/" />Sign In</a>
				</div>';
			} else {
				//I'll create original images for these at some point to save space
				echo '<div id="menu">
					<a href="./home.php" />Home</a>
					<a href="'.$user.'" />Profile</a>
					<a href="./account_settings.php" />Account Settings</a>
					<a href="./my_messages.php" />Inbox ('.$unread_numrows.')</a>
					<a href="./friend_requests.php" />Friend Requests ('.$requests_numrows.')</a>
					<a href="./my_pokes.php" />Pokes ('.$pokes_numrows.')</a>
					<a href="./logout.php" id="logout"/>Log Out</a>
				</div>';

				date_default_timezone_set('America/Detroit');
				$time = date("g:i:s A");
				$time_query = mysqli_query($connect,"UPDATE users SET time_last_seen='$time' WHERE username='$user'");

			}
				?>
			</div>
		</div>
		<div class="wrapper">
		<script language="javascript">
		$('#logout').click(function() {
			$.ajax({url: "./set_offline.php", success: function() { 
			});
		});
		</script>