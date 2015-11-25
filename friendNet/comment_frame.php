<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<style type="text/css">
	* {
		background-color: transparent !important;
		font-size: 12px;
	}

	a {
		color: #000000;
		text-decoration: none;
		font-size: 14px;
	}

	a:hover {
		text-decoration: underline;
	}

	hr {
		background-color: #C0C0C0 !important;
		width: 100%;
		height: 1px;
	}

</style>
<?php
	include("./inc/connect.inc.php");

	?>

	<div style='float:right; display: inline;'><a href="#" style='font-size: 12px;'>Post a Comment</a></div>

	<?php
	$getid = $_GET['id'];
	$get_comments = mysqli_query($connect,"SELECT * FROM post_comments WHERE post_id='$getid' ORDER BY id ASC");
    $count = mysqli_num_rows($get_comments);
    
    if ($count != 0) {
	    while ($comment = mysqli_fetch_assoc($get_comments)) {
		    $comment_body = $comment['post_body'];
		    $posted_to = $comment['posted_to'];
		    $posted_by = $comment['posted_by'];
		    $removed = $comment['post_removed'];

		    echo "<div class='comment'><b style='font-size: 14px;'>$posted_by said: </b><br />".$comment_body."</div><hr /><br />";
		}
	} else {
		echo "<center><br /><br /><h1>No Comments!</h1></center>";
	}

?>