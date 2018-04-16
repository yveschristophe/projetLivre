<?php include "templates/header.php"; ?>
<h1>Bienvenue <?= $_SESSION['auth']->username;?></h1>
<ul>
	<li><a href="event.php"><strong>Create</strong></a> Add an event</li>
</ul>

<?php
	require "functions.php";
	require "../connection.php";

	if(isset($_POST['delete'])){
		if(delete_event(filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT))){
			header('Location: index.php');
			exit;
		}
	}
?>

<ul>
<?php
foreach(get_event_list() as $event){
	echo "<div id='Mycontainer'>
	<a href='event.php?id=".$event['id']."'>". $event["name"] . 
	"</a>";
	echo "<p>" . $event["description"] . "</p>";
	echo "<a href='event.php?id=".$event['id']."'><img src=".$event["image"]."/></a>";
	echo "</div>";
}
?>
</ul>


<?php include "templates/footer.php"; ?>