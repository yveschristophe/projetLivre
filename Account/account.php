<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css"  href="css/account.css">
	<title>Document</title>
</head>
<body>
<center>
<?php
require 'inc/functions.php';
logged_only();
require 'inc/header.php';
?>
<h1>Bienvenue <?=$_SESSION['auth']->username;?></h1>





<?php
	require 'crud/public/functions.php';
	require  'crud/connection.php';

	if(isset($_POST['delete'])){
		if(delete_event(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
			header('Location: account.php');
			exit();
		}
	}
?>

<ul>
<?php
foreach(get_event_list() as $event){
	echo "<div id='Mycontainer'>
	<a href='./crud/public/event.php?id=".$event['id']."'><img src=".$event["image"]."/></a>";

	echo "<div id='ContentContainer'>
	<a href='./crud/puclic/event.php?id=".$event['id']."'><h1>".$event['name']."</h1></a>";
	echo "<p>" . $event["description"] . "</p>";
	echo "<input type='hidden' value='".$event['id']."' name='delete' />\n";
	echo "<input type='submit'  class='btn btn-primary' value='Supprimer' />\n";
	echo "</div>";
	echo "</div>";
}
?>
</ul>
</center>

<?php require 'inc/footer.php'; ?>

</body>
</html>
