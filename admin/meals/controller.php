<?php
require_once ("../../include/initialize.php");
  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect("../admin/index.php");
     }
if(!$_SESSION['ADMIN_ROLE']=='Administrator'){
  redirect("../admin/index.php");
}
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add' :
	doInsert();
	break;
	case 'edit' :
	doEdit();
	break;
	case 'delete' :
	doDelete();
	break;
	case 'photos' :
	doupdateimage();
	break;
	case 'banner' :
	setBanner();
	break;
 case 'discount' :
	setDiscount();
	break;
	}
function doInsert(){
	if(isset($_POST['save'])){
			$errofile  = $_FILES['image']['error'];
			$type      = $_FILES['image']['type'];
			$temp      = $_FILES['image']['tmp_name'];
			$myfile    = $_FILES['image']['name'];
		 	$location  = "uploaded_photos/".$myfile;
		if ( $errofile > 0) {
				// message("No Image Selected!", "error");
				redirect("index.php?view=add");
		}else{
				@$file=$_FILES['image']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
				@$image_name= addslashes($_FILES['image']['name']);
				@$image_size= getimagesize($_FILES['image']['tmp_name']);
			if ($image_size==FALSE || $type=='video/wmv') {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=add");
			}else{
					//uploading the file
					move_uploaded_file($temp,"uploaded_photos/" . $myfile);
					if ($_POST['MEALS'] == "" OR $_POST['PRICE'] == "") {
					$messageStats = false;
					message("All fields are required!","error");
					redirect('index.php?view=add');
					}else{
						$autonumber = New Autonumber();
						$res = $autonumber->set_autonumber('MEALID');
  				 	 	  $categoryid = $_POST['CATEGORYID'];
						  $category = New Category();
						  $singlecategory = $category->single_category($categoryid);
  				 	 	$meal = New Meal();
  				 	 	$meal->MEALID 			= $res->AUTO;
						$meal->MEALS 			= $_POST['MEALS'];
						$meal->CATEGORIES 		= $singlecategory->CATEGORY;
						$meal->CATEGORYID	    = $_POST['CATEGORYID'];
						$meal->PRICE			= $_POST['PRICE'];
						$meal->MEALPHOTO 		= $location;
						$meal->create();
						// }
						$autonumber = New Autonumber();
						$autonumber->auto_update('MEALID');
						message("New [ ". $_POST['MEALS'] ." ] creado con éxito!", "success");
						redirect("index.php");
						}
					}
			}
		  }
	  }
	function doEdit(){
		if(isset($_POST['save'])){
					if ($_POST['MEALS'] == "" OR $_POST['PRICE'] == "") {
					$messageStats = false;
					message("All fields are required!","error");
					redirect('index.php?view=edit');
					}else{
						@$categoryid = $_POST['CATEGORYID'];
						$category = New Category();
						@$singlecategory = $category->single_category(@$categoryid);
  				 	 	$meal = New Meal();
						$meal->MEALS 			= $_POST['MEALS'];
						$meal->CATEGORIES 		= $singlecategory->CATEGORY;
						$meal->CATEGORYID	    = $_POST['CATEGORYID'];
						$meal->PRICE			= $_POST['PRICE'];
						$meal->update($_POST['MEALID']);
						message("[ ". $_POST['MEALS'] ." ] Ha sido actualizado!", "success");
						redirect("index.php");
					}
	  }
}
	function doDelete(){
		// if (isset($_POST['selector'])==''){
		// 	message("Select the records first before you delete!","error");
		// 	redirect('index.php');
		// 	}else{
		// 	$id = $_POST['selector'];
		// 	$key = count($id);
		// 	for($i=0;$i<$key;$i++){
		// 	$product = New Product();
		// 	$product->delete($id[$i]);
		// 	$stockin = New StockIn();
		// 	$stockin->delete($id[$i]);
		// 	$promo = New Promo();
		// 	$promo->delete($id[$i]);
				$id = 	$_GET['id'];
				$meal = New Meal();
	 		 	$meal->delete($id);
			message("Product has been Deleted!","info");
			redirect('index.php');
			// }
		// }
	}
	function doupdateimage(){
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="uploaded_photos/".$myfile;
		if ( $errofile > 0) {
				// message("No Image Selected!", "error");
				redirect("index.php");
		}else{
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']);
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);
			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_POST['MENUID']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"uploaded_photos/" . $myfile);
					$meal = New Meal();
					$meal->MEALPHOTO 			= $location;
					$meal->update($_POST['mealid']);
					// redirect("index.php");
					message("Image successfully Updated!", "success");
					redirect("index.php?view=view&id=".$_POST['mealid']);
			}
		}
		}
	function setBanner(){
		$promo = New Promo();
		$promo->PROBANNER  =1;
		$promo->update($_POST['PROID']);
	}
 	function setDiscount(){
 		if (isset($_POST['submit'])){
		$promo = New Promo();
		$promo->PRODISCOUNT  = $_POST['PRODISCOUNT'];
		$promo->PRODISPRICE  = $_POST['PRODISPRICE'];
		$promo->PROBANNER  =1;
		$promo->update($_POST['PROID']);
		msgBox("Discount has been set.");
		redirect("index.php");
 		}
	}
	function removeDiscount(){
 		if (isset($_POST['submit'])){
		$promo = New Promo();
		$promo->PRODISCOUNT  = $_POST['PRODISCOUNT'];
		$promo->PRODISPRICE  = $_POST['PRODISPRICE'];
		$promo->PROBANNER  =1;
		$promo->update($_POST['PROID']);
		msgBox("Discount has been set.");
		redirect("index.php");
 		}
	}
?>