<?php

function get_event_list(){
    include "./crud/connection.php";
    

    try{
        return $reponse = $connection->query("SELECT * FROM event INNER JOIN users ON event.id_event = users.id WHERE id_event= ".$_SESSION['auth']->id."");
    } catch(PDOException $e){
       echo "Error : ". $e->getMessage();
       return false; 
    }
}

function get_event($id){
    include "../connection.php";
    try{
        $sql= "SELECT * FROM event WHERE id= ?";
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return $result->fetch();
}

function add_event($name, $id_event, $description, $image, $id=null){
    include "../connection.php";
    $users_id = $_SESSION['auth']->id;

    if($id){
        $sql = "UPDATE event SET name = ?,id_event = ".$_SESSION['auth']->id.", description = ?, image = ? WHERE id = ?";
    } else {
        $sql = "INSERT INTO event (name, id_event, description, image) VALUE(?, ".$_SESSION['auth']->id.", ?, ?)";
    }

    try{
        $result= $connection->prepare($sql);
        $result->bindValue(1, $name, PDO::PARAM_STR);
        $result->bindValue(2, $description, PDO::PARAM_STR);
        $result->bindValue(3, $image, PDO::PARAM_STR);
        if($id){
            $result->bindValue(4, $id,PDO::PARAM_INT);
        }
        echo $sql;
        $result->execute();
    } catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}

function delete_event($id){
    include "../connection.php";

    $sql="DELETE FROM event WHERE id= ?";

    try{
        $result=$connection->prepare($sql);
        $result->bindValue(1, $id, PDO::PARAM_INT);
        $result->execute();
    }
    catch(Exception $e){
        echo $e->getMessage();
        return false;
    }
    return true;
}
?>