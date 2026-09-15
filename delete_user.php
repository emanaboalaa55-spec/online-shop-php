<?php
session_start();

include "connect.php";

if (isset($_POST['bulk_delete_btn']) && !empty($_POST['user_ids'])) {
    $sanitized_ids = array_map('intval', $_POST['user_ids']);
    $ids = implode(',',$_POST['user_ids']);
   $query =  $conn->query("DELETE FROM users WHERE id IN ($ids)");
   if ($query) {
    header("Location:../design/user_view.php");
     exit();
   } else {
    echo "Error: ". $conn->error;
   }
}
    // foreach ($user_ids as $id) {
    //     $id = (int) $id;
    //     $del = "DELETE FROM users WHERE id = $id";
    //     $query = $conn->query($del)
    // }
    // header('Location: ../design/users.php');
    // exit();

        elseif (isset($_GET['id'])) {
$id = $_GET['id'];


$query = $conn->query("DELETE FROM users WHERE id = $id");


 if ($query) {


    header('location:../users.php');
    exit();
  } else {
    echo "Error: " .  $conn -> error ;

    // header("location: ../design/user_view.php");
    exit();
}

 }

?>