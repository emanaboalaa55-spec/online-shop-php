
<?php
$id = $_GET['id'];

include "functions/connect.php";
$select = "SELECT * FROM users WHERE id = $id";
$query = $conn -> query($select);
$user = $query -> fetch_assoc();
// print_r($user);
?>
<form method="post" action="functions/update_user.php">
<input type="hidden" name="id" value="<?= $user['id'] ?>">

    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" name="username" value="<?= $user['username'] ?>"
     class="form-control" id="exampleInputEmail1">
</div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" value="<?= $user['email'] ?>"
    class="form-control" id="email"
    placeholder="Enter email">
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input"
    type="radio" name="gender" id="inlineRadio1" value="0"
     <?= $user['gender'] == 0 ? 'checked' : '' ?> 
     >
    <label class="form-check-label" for="inlineRadio1">Male</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="1" 
    <?= $user['gender'] == 1 ? 'checked' : '' ?>
     >
    <label class="form-check-label" for="inlineRadio2">Female</label>
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" value="<?= $user['address'] ?>"
    placeholder="Enter address">
</div>
<br>
<div class="form-group">
    <label for="privileges">Privileges</label>
    <select name="priv"
    class="form-control" id="privileges">
    <option value="0"
    <?= $user['priv'] == 0 ? 'selected' : '' ?>
    >Admin</option>
    <option value="1"
   <?= $user['priv'] == 1 ? 'selected' : '' ?> 
    >User</option>
</select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>