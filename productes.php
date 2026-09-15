 <?php

  session_start();
if (isset($_SESSION['privilege_id'])) {
	$_SESSION['privilege'] = $_SESSION['privilege_id'];
}

// if (!isset($_SESSION['login_id']))  {
// 	header("location: login.php");
// 	exit();
// }

	include 'includes/header.php';
	include 'includes/sidebar.php';
	?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">productes</li>
			</ol>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">productes</h1>
			</div>
		</div>
<div class="row">
        <div class="col-lg-12">
<?php
//  if (!isset($_GET['action'])) {
// 	 include "design/productes/view.php";

//  } elseif ($_GET['action'] == 'add') {
// 	 include "design/productes/add.php";

//  } elseif($_GET['action'] == 'edit') {
// 	include "design/edit_user_form.php";
//  }
$action = isset($_GET['action']) ?
$_GET['action'] : '';
if ($action == 'add') {
	include "design/productes/add.php";
} elseif ($action == 'edit') {
	include "design/productes/edit.php";
} else {
	include "design/productes/view.php";
}

?>
</div>	
</div>	
<?php
include 'includes/footer.php';
?> 