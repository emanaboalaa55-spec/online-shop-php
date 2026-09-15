<?php
  error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

include "connect.php";

 $check = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$query = $conn -> query($check);
if (!$query) {
    die($conn->error);
}
if ($query -> num_rows > 0) {
    $user = $query -> fetch_assoc();
    $id = $user['id'];
    
    $privilege = $user['privilege_id'];
    
    $_SESSION['login_id'] = $id ;
    $_SESSION['user_id'] = $id ;
    $_SESSION['privilege'] = $privilege;

    if($privilege == 1){
        header('location:../index.php');
        exit();
    } else if ($privilege == 2) {
        header("Location: ../../product.php");
        exit();
    }

if (isset($_POST['remember'])) {

    $token = bin2hex(random_bytes(16));

    $cookie_expire = time() + (86400 * 30);

    setcookie('remember_token', $token, $cookie_expire, "/");

    $expire_date_db = date('y-m-d H:i:s', $cookie_expire);

    $insert_token = "INSERT INTO user_tokenS (user_id, token, expires_at)
            VALUES ('$id', '$token', '$expire_date_db')";

            $conn->query($insert_token);

}

if ($_SESSION['privilege'] == 2) {
    header("Location: ../../product.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}

// if ($_SESSION['privilege'] == 2) {
//   header("location: ../../product.php");
// exit();
// }else {
//   header("Location: ../users.php");
//   exit();
// }
// header("Location:../index.php " );
// // . ($_SESSION['privilege'] == 2 ? "../../product.php" : "../users.php"));
// exit();
//  }else {
//   $_SESSION['login_error'] = "<div class='alert alert-danger'>wrong credentials</div>";
//  header("location: ../login.php");
//  exit();

 }
 ?>

