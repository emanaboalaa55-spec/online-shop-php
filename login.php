<?php
session_start();
include "functions/connect.php"; 

 if (isset($_SESSION['login_id']) && isset($_SESSION['privilege_id'])) {
 	if ($_SESSION['privilege_id'] == 2) {
// 		header("Location: users.php");
 	exit();
 	}
 else {
	header("Location: ../product.php");
 	exit();
 }
 }
if (isset($_COOKIE['remember_token'])) {
	$token = $_COOKIE['remember_token'];
	$current_time = date('y-m-d H:i:s');

 	$token_query = "SELECT * FROM user_tokenS WHERE token = '$token' AND expires_at > '$current_time' LIMIT 1";
 	$result = $conn->query($token_query);

	if ($result && $result->num_rows > 0) {
		$token_data = $result->fetch_assoc();
 		$user_id = $token_data['user_id'];

         $user_res = $conn->query("SELECT privilege_id FROM users WHERE id = '$user_id'");

 		 $user_row = $user_res->fetch_assoc();
		 if($user_res && $user_row){
	    $_SESSION['login_id'] = $user_id;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['privilege_id'] =  $user_row['privilege_id'];	
        // $_SESSION['privilege'] = $user_row['privilege_id'];

		if($_SESSION['privilege_id'] == 2) {
			header("Location: ../product.php");
		} else {
			header("Location: users.php");
		}
			exit();
	}
		
	}
}

		
 
if (isset($_POST['login_btn'])) {
	$email = $conn->real_escape_string($_POST['email']);
	$password = $_POST['password'];

	$query = "SELECT * FROM users WHERE email = '$email' AND password =  '$password'";
	$result = $conn->query($query);

	if ($result && $result->num_rows > 0){
	 $user_row = $result->fetch_assoc(); 
	$_SESSION['login_id'] = $user_row['id'];
	$_SESSION['privilege_id'] = $user_row['privilege_id'];

			if(isset($_POST['remember'])) {
				$token = bin2hex(random_bytes(16));
				$conn->query("INSERT INTO user_tokens (user_id, token, expires_at) VALUES ('$user_static_id', '$token', DATE_ADD(NOW(), INTERVAL 30 DAY))");
				setcookie('remember_token', $token, time() + (86400 * 30), "/");
			}
			if ($_SESSION['privilege_id'] == 2) {
				header("location: ../product.php");
				exit();
	} elseif ($_SESSION['privilege_id'] == 1 || $_SESSION['privilege_id'] == 3) {
		header("Lcation: users.php");
		exit();
	}
} else { 
$_SESSION['login_error'] = "بيانات الدخول غير صحيحه";}
	
}
?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				
				<div class="panel-body">
	
					<form role="form" method="post" action="functions/LoginCheck.php">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" name="login_btn" class="btn btn-primary">Login</button>
</fieldset>
					</form>
				</div>
			</div>
			<div>
				<?php
			if (isset($_SESSION['login_error'])) {
			echo $_SESSION['login_error'];
			unset($_SESSION['login_error']);
			}
				?>
			</div>
		</div>
		<?php
		if (isset($_SESSION['login_error'])) {
			echo ($_SESSION['login_error']);

			unset($_SESSION['login_error']);
		}
		?>
	</div>	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
