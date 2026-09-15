 <?php
// include('../../functions/connect.php');
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $query = "DELETE FROM products WHERE id = '$id'";
//     $result = mysqli_query($conn, $query);
//     if ($result) {
//         header("Location: ../../products.php");
//         exit();
//     }else {
//         echo "حدث خطا اثناء الحذف: " .mysqli_error($conn);
//     }
// } 
// ob_start();
include ('../../functions/connect.php');

    $id = $_GET['id'];
    $conn->query ("DELETE FROM products WHERE id = '$id'");
    // $query = $conn -> query($del);
    // if ($query) {
        header("location: ../../productes.php");
        exit();
    
// }else {
    // echo "Error: " . $conn -> error ;

// }

?>