<?php
ob_start();
include_once "functions/connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $description = $_POST['description'];

    if (!empty($_POST['category_id'])) {
        $category_id =  $_POST['category_id'];
    } else {
        $category_id = "NULL";
    }
    
    $query = "INSERT INTO products (name, price, sale, description, category_id)
    VALUES ('$name', '$price', '$sale', '$description', $category_id)";
    $conn->query($query);
    $product_id = $conn->insert_id;

    if (!empty($_FILES['image']['name'])) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $target  = "images/" . $img_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {

            //  $query = "UPDATE productes SET image = '$img_name' WHERE id = '$product_id'";
                          $query = "INSERT INTO product_images (product_id, images_name) VALUES ('$product_id', '$img_name')";
                         mysqli_query($conn, $query);
        }
    }
    echo "<script>windo. location.href='productes.php';</script>";
    // header("Location: productes.php");
    // exit();
}
?>
    <form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">name</label>
        <input type="text" name="name"
     class="form-control" id="exampleInputEmail1">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">price</label>
    <input type="text" name="price"
    class="form-control" id="exampleInputEmail1">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">sale</label>
    <input type="text" name="sale"
    class="form-control" id="exampleInputEmail1">
</div>
<div class="form-group">
    <label for="exampleInputEmail1">images</label>
    <input type="file"  multiple name="image" class="form-control" id="exampleInputEmail1">
</div>
<div class="form-group">
    <label for="email">description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<br>
<div class="form-group">
    <label for="exampleControlSelect1">category</label>
    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
        <option value="">Choose category...</option>
        <?php
        include "functions/connect.php";
        $select = "SELECT * FROM categories";
        $query = $conn -> query($select);
        foreach($query as $category) {
        ?>
    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
    <?php } ?>
</select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>