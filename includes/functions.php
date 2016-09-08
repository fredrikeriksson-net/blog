<?php

function add($title, $content, $author){
	
	include '../includes/handler.php';

	try {
	$query = ('INSERT INTO blog_tbl (title, content, author) VALUES (:title, :content, :author)');

	$stmt = $handler->prepare($query);

	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':content', $content);
	$stmt->bindParam(':author', $author);

	$stmt->execute();

	header("Location: admin.php?confirmation=Blogpost posted");
	}

	catch (PDOException $e) {
	echo 'Cant post blogpost <br>';
	echo $e->getMessage();
	}
}


function edit($id, $title, $content, $author){
	
	include '../includes/handler.php';

	try {
	$query = ("UPDATE blog_tbl SET title=:title, content=:content, author=:author WHERE id='$id'");

	$stmt = $handler->prepare($query);

	$stmt->bindParam(':title', $title);
	$stmt->bindParam(':content', $content);
	$stmt->bindParam(':author', $author);

	$stmt->execute();

	header('Location: edit.php?confirmation=Post is saved');
	}

	catch (PDOException $e) {
	echo 'Cant edit blogpost <br>';
	echo $e->getMessage();
	}
}

function del($id, $title, $content, $author){

	include '../includes/handler.php';

	try {
	$query = (" DELETE FROM blog_tbl WHERE id='$id'");

	$stmt = $handler->prepare($query);

	$stmt->execute();

	header('Location: edit.php?confirmation=Post is deleted');
	}

	catch (PDOException $e) {
	echo 'Cant delete blogpost <br>';
	echo $e->getMessage();
	}
	
}

function showPosts (){

	include '../includes/handler.php';

	if(isset($_GET['order']) && $_GET['order'] === "desc"){
	$order = "asc";
	echo "<span class='date'>Earliest</span>";
	}

	else {
	$order = "desc";
	echo "<span class='date'>Latest</span>";
	}

	echo "<a class='date' href='index.php?order=$order'>Order by date</a>";

	$showPosts = "SELECT * FROM blog_tbl ORDER BY published_date $order";

	$query = $handler->query($showPosts);

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

	echo '<article class="blogPost">';
	echo '<h2>' . $row['title'] . '</h2>';
	echo '<p>' . $row['content'] . '</p>';
				
	echo 	'<footer>
			<span class="author">Author: ' . $row['author'] . '</span>
			<span class="timestamp">Posted: ' . $row['published_date'] . '</span>
			</footer>';
	echo '</article>';
			
	}
}

function getBlogpost(){

	include '../includes/handler.php';

	@$showEditPost = " SELECT * FROM blog_tbl WHERE id ='$_GET[id]' ";

	$queryEdit = $handler->query($showEditPost);

	while ($editRow = $queryEdit->fetch(PDO::FETCH_ASSOC)) {

	echo '<h2 class="header">Edit / Delete Post</h2>';

	echo '<form action="" method="POST" id="theEditForm">';
	
	echo '<p><input type="hidden" name="id" placeholder="ID" value=" ' . $editRow['id'] . ' "></p>';
	echo ' <p><input type="text" name="title" placeholder="Edit Title" value=" ' . $editRow['title'] .  ' "></p>';
	echo '<p><textarea name="content" form="theEditForm" placeholder="Content" rows="10" cols="40"> ' . $editRow['content'] . '</textarea></p>';
	echo '<p><input type="text" name="author" placeholder="Edit author" value=" ' . $editRow['author'] .'"></p>';
	echo '<p><input type="submit" class="ok" name="edit" value="Save post"></p>';
	echo  '<p><input type="submit" class="warning" name="del" value="Delete post"></p>';
	echo '</form>';

	 }
}

function showTitle(){

	include '../includes/handler.php';

	$showAllPosts = 'SELECT * FROM blog_tbl';

	$query = $handler->query($showAllPosts);

	while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

	echo '<article class="blogPost">';
	echo "<h2>" . $row['title'];
	echo "<span class='edit'> <a class='date' href=edit.php?id=" . $row['id'] . "> Edit / Delete</span></a></h2>";
	echo "</article>";

	}
}


?>