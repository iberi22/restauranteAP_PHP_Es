
<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['ADMIN_USERID'])){
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


	}

	function doInsert(){
		if(isset($_POST['save'])){


		if ( $_POST['AUTOSTART'] == "" ) {
			$messageStats = false;
			message("Todo el campo es obligatorio!","error");
			redirect('index.php?view=add');
		}else{
			$autonumber = New Autonumber();
			$autonumber->AUTOSTART	= $_POST['AUTOSTART'];
			$autonumber->AUTOEND	= $_POST['AUTOEND'];
			$autonumber->AUTOKEY	= $_POST['AUTOKEY'];
			$autonumber->create();

			message("Autonumeración creado con éxito!", "success");
			redirect("index.php");

		}
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){

			$autonumber = New Autonumber();
			$autonumber->AUTOSTART	= $_POST['AUTOSTART'];
			$autonumber->AUTOEND	= $_POST['AUTOEND'];
			$autonumber->update($_POST['AUTOKEY']);

			message("Autonumeración ha sido actualizado!", "success");
			redirect("index.php");
		}

	}


	function doDelete(){
		// if (isset($_POST['selector'])==''){
		// message("Select a records first before you delete!","error");
		// redirect('index.php');
		// }else{

			$id = $_GET['id'];

			$autonumber = New Autonumber();
			$autonumber->delete($id);

			message("Autonumeración ya eliminada!","info");
			redirect('index.php');

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$autonumber = New autonumber();
		// 	$autonumber->delete($id[$i]);

		// 	message("autonumber already Deleted!","info");
		// 	redirect('index.php');
		// }
		// }

	}
?>