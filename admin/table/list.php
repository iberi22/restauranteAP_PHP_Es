<?php
if (!isset($_SESSION['ADMIN_USERID'])) {
                redirect("../admin/index.php");
}
?>
<style type="text/css">
	.table-responsive {
		 border: none;
	}
	@media (min-width: 768px) {

}

</style>
<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Lista de Mesas
        <a href="controller.php?action=add" class="btn btn-primary btn-s  ">  <i class="fa fa-plus-circle fw-fa"></i> Agregar Mesa</a>
    </h1>
</div>
            <!-- /.col-lg-12 -->
            </div>
                 <form action="controller.php?action=delete" Method="POST">
                 <div style="overflow-x: unset;" class="table-responsive">
                <table id="dash-table" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
                  <thead>
                      <tr>
                          <!-- <th>No.</th> -->
                          <th style="font-size: 15px; text-align: center;" width="10%">
                           <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
                           N. Mesa</th>
                           <th style="font-size: 15px;" width="20%">Cliente</th>
                           <th style="font-size: 15px;" width="11%">Tiempo</th>
                           <th style="font-size: 15px; text-align: center;" width="10%">Estado</th>
                           <th style="font-size: 15px; text-align: center;" width="23%">Acciones</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
$mydb->setQuery("SELECT * FROM `tbltable` ORDER BY TABLENO ASC");
$cur = $mydb->loadResultList();
foreach ($cur as $result) {
    echo '<tr>';
    if ($result->STATUS == 'Reserved') {
                    $btn        = "Cancel";
                    $reservebtn = "Cancel";
                    $resdisable = "Disabled";
                    $titlebtn   = "Cancel";
                    $disable    = '';
                    $time       = $result->RESERVEDTIME;
                    $url        = "controller.php?action=reserve&id=" . $result->TABLEID;
                    $customer   = $result->CUSTOMER;
    } elseif ($result->STATUS == 'Available') {
                    $btn        = "Reservar";
                    $reservebtn = "Reserve";
                    $titlebtn   = "Cancel";
                    $resdisable = "";
                    $disable    = '';
                    $time       = "";
                    $url        = "index.php?view=add&id=" . $result->TABLEID;
                    $customer   = "";
    } elseif ($result->STATUS == 'Occupied') {
                    $btn        = "Ocupada";
                    $reservebtn = "Reserve";
                    $resdisable = "";
                    $titlebtn   = "Cancel";
                    $disable    = 'Disabled';
                    //$time =$result->RESERVEDTIME;
                    $customer   = "";
                    $time       = "";
                    $url        = "";
    }
    echo '<td style="font-size:25px; text-align:center; font-weight:bold;">' . $result->TABLENO . '</td>';
    echo '<td style="font-size:20px;">' . $customer . '</td>';
    echo '<td style="font-size:20px;">' . $time . '</td>';
    echo '<td style="font-size:20px; text-align:center;">' . $result->STATUS . '</td>';
    echo '
            <td align="center">
	            <a title="' . $reservebtn . '" href="' . $url . '" class="btn btn-success btn-s  click_reserve" ' . $disable . '>  <span class="fa fa-bookmark fw-fa"> ' . $btn . '
	           	</a>
                <a title="Edit" href="index.php?view=edit&id=' . $result->TABLEID . '" class="btn btn-primary btn-s">
                    <span class="fa fa-pencil fw-fa">
                </a>
               <a title="Remove" href="controller.php?action=delete&id=' . $result->TABLEID . '" class="btn btn-danger btn-s  "' . $disable . '' . $resdisable . '>  <span class="fa  fa-trash-o fw-fa " >
               </a>
            </td>';
    echo '</tr>';
}
?>
                 </tbody>
                </table>
<div class="btn-group">

<?php
	if ($_SESSION['ADMIN_ROLE'] == 'Administrator') {
	                 // echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
	                ;
	}
?>
</div>
                </form>
 <div class="table-responsive">