<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 session_start();
    if (isset($_SESSION['privilege_id'])) {
		$_SESSION['privilege'] = $_SESSION['privilege_id'];
	}

	if (!isset($_SESSION['login_id']))  {
 	 header("Location: ../login.php");
	 	exit();
	 }
//  if  ($_SESSION['privilege'] != 2) {
	// header("Location: ../product.php");
 	// exit();
//  }

	include 'includes/header.php';
	include 'includes/sidebar.php'; 

	?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">users</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">users</h1>
			</div>
		</div>
<div class="row">
        <div class="col-lg-12">
<?php
// if (isset($_GET['action'])) {
	// include "design/user_view.php";

// } elseif ($_GET['action'] == 'add') {
	// include "design/add_user_form.php";

// } elseif($_GET['action'] == 'delete') {
	// include "functions/delete_user.php";
// }
if(!isset($_GET['action'])){
  include 'design/user_view.php';
}elseif ($_GET['action'] == 'add') {
	include "design/add_user_form.php";
} elseif ($_GET['action'] == 'edit') {
	include "design/edit_user_form.php";
} 

?>
</div>	
</div>	
<?php
include 'includes/footer.php';
?>