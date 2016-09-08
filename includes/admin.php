<?php
include_once '../includes/handler.php';
include_once '../includes/functions.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Fredrik Eriksson - POST</title>
    <link rel="stylesheet" href="../public/css/normalize.css">
    <link rel="stylesheet" href="../public/css/main.css">
		<link href='https://fonts.googleapis.com/css?family=Lato:300,300italic,400,400italic,700,700italic,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
  </head>
  <body>

		<div id="wrapper">
		
			<h1>Admin - Fredrik Eriksson</h1>
			<a class="admin" href="../public/index.php">Back to blog</a> <a class="active" href="../includes/admin.php">Post</a> <a class="admin" href="../includes/edit.php">Edit / Delete</a>
						
			<?php 

			// Add post med felhantering
			if(isset($_POST['title'], $_POST['content'], $_POST['author'])){

				$errors = array(); //Tom array för errors

				// Tar bort tecken man inte vill ha och blanksteg
				$title = htmlentities(trim($_POST['title']));
				$content = htmlentities (trim($_POST['content']));
				$author = htmlentities (trim($_POST['author']));

				// Sätter error meddelanden
				if(empty($title)){
					$errors[] = 'Enter a title';
				}
				else if (strlen($title) > 30) {
					$errors[] = 'Title cant be more than 30 characters';
				}
				else if (strlen($title) < 5){
					$errors[] = 'Title must be at least 5 characters long';
				}

				if(empty($content)){
					$errors[] = 'Enter content';
				}

				if(empty($author)){
					$errors[] = 'Enter an author';
				}
				else if (strlen($author) > 30) {
					$errors[] = 'Author cant be more than 30 characters';
				}

				if(empty($errors)){
					add($title, $content, $author);
				}
			}

			?>			

			<h2 class="header">Post</h2>
			<form action="" method="POST" id="theForm">
			<p><input type="text" name="title" placeholder="Title" value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>"></p>
			<p><textarea name="content" form="theForm" placeholder="Content" rows="10" cols="40"><?php if(isset($_POST['content'])) echo $_POST['content']; ?></textarea></p>
			<p><input type="text" name="author" placeholder="Author" value="<?php if(isset($_POST['author'])) echo $_POST['author']; ?>"></p>
			<p><input type="submit" class="ok" value="Submit to blog"></p>
			</form>

			<p> <?php echo @$_GET['confirmation'];?> </p> <!-- Visar att inlägget är postat -->
			

			<?php

			// Visar error meddelanden
			if(isset($errors) && !empty($errors)){
				
				echo "<h2 class='error'>Error(s)</h2>";
				
				for($i = 0; $i < count($errors); $i++){
					echo '<p>' . $errors[$i] . '</p>';	
				}
			}

			?>

		</div>
		
  </body>
</html>