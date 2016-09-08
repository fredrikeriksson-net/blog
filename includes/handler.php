<?php

// Databas kopplingen

try {
	$handler = new PDO('mysql:host=localhost;dbname=blog_db' , 'root');
	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo 'Database error <br>';
	echo $e->getMessage();
}

?>

