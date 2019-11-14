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
                        <th style="font-size: 15px; text-align: center;" width="10%">NUMERO PEDIDO</th>
                        <th style="font-size: 15px; text-align: center;" width="2%">N. MESA</th>
                        <th style="font-size: 15px;" width="20%">PLATO</th>
                        <th style="font-size: 15px;" width="11%">TIEMPO DE LA ORDEN</th>

                      </tr>
                  </thead>
                  <tbody>
                      <?php
$mydb->setQuery("SELECT * FROM `tblorders` ORDER BY TABLENO ASC");
$cur = $mydb->loadResultList();
// var_dump($cur);
foreach ($cur as $result) {
    echo '<tr>';
    echo '<td style="font-size:20px;">' . $result->ORDERNO . '</td>';
    echo '<td style="font-size:20px;">' . $result->TABLENO . '</td>';
    echo '<td style="font-size:20px;">' . $result->DESCRIPTION . '</td>';
    echo '<td style="font-size:20px; text-align:center;">' . $result->DATEORDERED . '</td>';

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