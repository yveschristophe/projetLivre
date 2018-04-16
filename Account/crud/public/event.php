<!DOCTYPE html>
<html lang="en">
<head>
	<link rel='stylesheet' type='text/css' href="css/event.css" >
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<?php
require "functions.php";
session_start();
if(isset($_GET['id'])){
	list($id, $name, $id_event, $description, $image) = get_event(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
	$id=filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
	$id_event = filter_input(INPUT_POST, 'id_event', FILTER_SANITIZE_NUMBER_INT);
	$description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
	$image = trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_URL));
	

	if(empty($name) || empty($description) || empty($image)){
		$error_message= "Please fill in the required fields";
	} else {

		if(add_event($name, $id_event, $description, $image, $id)){
			header('Location: ../redirection.php');
			exit;
		} else {
			$error_message = "Could not add event";
		}
	}
}
?>

<?php require "../header.php"; ?>

<?php 
if(isset($error_message)){
	echo $error_message;
}
?>

<h2>
<?php
if(!empty($id)){
	echo "Update";
} else {
	echo "Add an event";
}
?></h2>

<form class="col-md-4" method="post" action="event.php">
	<div class="form-input">
		<label for="name">Titre</label>
		<input type="text" class="form-control" name="name" id="name" value="">
	</div>

	<div class="form-input">
		<label for="description">Résumé</label>
		<input type="textarea" class="form-control" name="description" id="description" value="">
	</div>
	<div class="form-input">
		<label for="image">Image</label>
		<input type="text" class="form-control" name="image" id="image" value="">
	</div>		
	<?php
	if(!empty($id)){
		echo '<input type="hidden" name="id" value="'.$id.'">';
		echo '<input type="hidden" name="id_event" value="'.$id_event.'">';
	}
?>	
	<div class="form-input">
		<input type="submit" class="btn btn-primary" name="submit" value="Envoyer">
	</div>	
</form>

<a href="../redirection.php">Retourner au menu</a>

<?php require "../footer.php"; ?>
</body>
</html>
