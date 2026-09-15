
<a class = "btn btn-primary" href="productes.php?action=add">Add Productes</a>
			<br>
</br> 
            <table class="table table-hover table-border table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>Price</th>
                        <th>Sale</th>
                        <th>Image</th>
                        <th>Category</th>
						<th>Controlls</th>
                    </tr>
                </thead>
                <tbody>
                
                     <?php
                    include "functions/connect.php";

                         $select = "SELECT * FROM products";

                      $selectproducts = "SELECT products.*, categories.name
                       AS category_name
                       FROM products
                        --  LEFT JOIN categories
                     -- RIGHT JOIN categories
                       INNER JOIN categories
                       ON products.category_id = categories.id
                        -- UNION
                        -- SELECT products.*, categories.name AS category_name
                        -- FROM products
                        -- RIGHT JOIN categories
                        -- ON products.category_id = categories.id";

                    $query = $conn->query($selectproducts);
                    foreach($query as $productes) {
                    ?>
                    <tr>
                        <td><?= $productes['id'] ?></td>
                        <td><?=  $productes['name'] ?></td>
                        <td><?= $productes['price'] ?></td>
                        <td><?= $productes['sale'] ?></td>
                        <!-- <td><?= $productes['category_name']?></td> -->
                        <td>

                            <?php
                            $product_id = $productes['id'];
                            $select_images = "SELECT images_name FROM product_images WHERE product_id = '$product_id'";
                            $query_images = $conn->query($select_images);

                        if ($query_images && $query_images->num_rows > 0) {    
                            foreach ($query_images as $img_row) {
                            // $images = explode(',',$productes['img']);
                            // foreach ($images as $image){ 
                                $img_name = trim($img_row['images_name']);
                                echo "<img src='images/$img_name' width='50' height='50' style='object-fit:cover; margin-right:3px;'>";
                            }
                        }
?>
                        </td>
                        <td><?= $productes['category_name'] ?></td>
                         
						<td>
                            <div class="btn-group btn-group-sm">
<a class="btn btn-primary" style="margin-right: 8px;" href="/my_project/admin/design/productes/edit.php?id=<?php echo $productes['id']; ?>">Edit</a>
 <a class="btn btn-danger" href="/my_project/admin/design/productes/delete.php?id=<?php echo $productes['id']; ?>">Delete</a>
 </div>                       
</td>
 </tr>
 <?php } 
 ?>
</tbody>
</table>
