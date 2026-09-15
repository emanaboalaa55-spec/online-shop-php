<!-- <!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head> -->
<!-- <body> -->
  <?php
// session_start();
// include '../includes/header.php'; 
// include '../includes/sidebar.php';
$is_admin = isset($_SESSION['privilege_id']) && ($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 'admin');
?>
<!-- <div class="col-sm-9 col-sm-offset-3 col=lg-10 col-lg-offset-2 main" style="margin-top: 20px;">
<div class="row">
  <div class="col-lg-12">
     <h1 class="page-header">Users</h1> -->
</div>
</div> 

<a class="btn btn-primary <?= !$is_admin ? 'disabled' : '' ?>" 
href="users.php?action=add"  
style="<?= !$is_admin ? 'pointer-events: none; opacity: 0.5;' : '' ?>">Add user</a>
<!-- onclick="return confirm('تاكيد الحذف')" -->
 
<form action="../functions/delete_user.php" method="POST">
  <button type="submit" name="bulk_delete_btn" >حذف المحدد</button>
            <table class="table table-hover table-border table-striped">
                <thead>
                
              <tr>
                      <th><input type="checkbox" id="select-all"></th>
                        <th>id</th>
                        <th>username</th> 
                        <th>email</th>
                        <th>gander</th>
                        <th>privliges</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once(__DIR__ . "/../functions/connect.php");
                    $select = "SELECT * FROM users";
                    $query = $conn->query($select);
                    foreach ($query as $user) {
                  ?>
                   <tr>
                    <td><input type="checkbox" name="user_ids[]" value="<?= $user['id']; ?>" class="user-checkbox"></td>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                          <?php
                        if($user['gender'] == 0 ) {
                            echo "Male";
                        }else {
                            echo "Female";
                        }
           ?>
           </td>
                        <td><?php
                        $row_priv = '';
                        if($user['privilege_id'] == 1)
                        {
                          $row_priv = 'owner';
                          echo $row_priv ;
                        }
                         
                         $row_priv = '';
                         if($user['privilege_id'] == 2) {
                          $row_priv = 'user';
                          echo $row_priv ;
                         }
                       
                       $row_priv = '';
                       if($user['privilege_id'] == 3) {
                        $row_priv = 'admin';
                        echo $row_priv ;
                       }
                       ?></td>
                      
           <td>
             <?php 
            $user_priv = $_SESSION['privilege'] ?? null;
             if ($user_priv == 1  ): ?> 
              
          <a class="btn btn-info" href="users.php?action=edit&id=<?= $user['id']; ?>">Edit</a>

						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?= $user['id']; ?>">Delete</button>	
            
            <?php elseif($user_priv == 3 && $row_priv != 2): ?>
              <a class="btn btn-info" href="javascript:void(0)">Edit</a>

<button type="button" class="btn btn-danger disabled" data-toggle="modal" data-target="#<?= $user['id']; ?>">Delete</button>	
<?php else : ?>
  
  <a class="btn btn-info" href="users.php?action=edit&id=<?= $user['id']; ?>">Edit</a>

						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#<?= $user['id']; ?>">Delete</button>
 <?php endif; ?>
</td>
<!-- Modal -->
<div class="modal fade" id="<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        are you sure you want to delete <span class="text-danger" style="font-weight:bold"><?= $user['username'] ?></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="../functions/delete_user.php?id=<?= $user['id'] ?>"  class="btn danger">confirm</a>
      </div>
    </div>
  </div>
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</form>

<script>
  document.getElementById('select-all').onclick = function() {
    document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = this.checked);
  }
  </script>
  <!-- <?php include '../includes/footer.php';?> -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundele.min.js"></script>
</body>
</html> -->
