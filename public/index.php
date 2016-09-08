<?php
include_once '../includes/handler.php';
include '../includes/functions.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Fredrik Eriksson</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  </head>
  <body>

		<div id="wrapper">
		
			<h1>Fredrik Eriksson Blog</h1>
			<a class="admin" href="../includes/admin.php">Admin</a>
			
			<?php 

				showPosts();
			
			?>

		</div>
		
  </body>
</html>