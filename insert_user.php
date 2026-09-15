<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
echo "<script>window.location.href='/my_project/admin/users.php';</script>";
exit();
}
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$priv = $_POST['priv'];


include_once "connect.php";

$insert = "INSERT INTO users
(username , password , email , address , gender , priv)
 VALUES 
 ('$username' , '$password' , '$email' , '$address' , '$gender' , '$priv')";

 $query = $conn -> query($insert);
 if ($query) {
    echo "<script>window.location.href='/my_project/admin/users.php';</script>";
    exit();
 } else {
   echo $conn -> error ;
 }
 ?>