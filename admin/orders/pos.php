	<?php
    if (!isset($_SESSION['ADMIN_USERID'])) {
        redirect("../admin/index.php");
    }
    // check_message();
    ?>
	<style type="text/css">
	    .scrolly {
	        /*width         : auto;*/
	        height: 268px;
	        /*border        : thin solid black;*/
	        overflow-x: hidden;
	        background-color: #eee;
	        /*overflow-y    : hidden;*/
	    }
	    .scrollorder {
	        /*width     : auto;*/
	        /* height   : 450px; */
	        /*border    : thin solid black;*/
	        overflow-x: hidden;
	        /*overflow-y: hidden;*/
	        padding: 0px;
	    }
	    .page-header {
	        font-size: 25px;
	        font-weight: bold;
	        margin-left: 0;
	    }
	    .form-control {
	        width: 59%;
	        margin-bottom: 20px;
	    }
	    .botones_acciones_pos {
	       display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: row;
            flex-direction: row;
	    }
	    input[type="checkbox"] {
	        width: 30px;
	        height: 30px;
	        margin-left: 80px;
	    }
        .links {
            text-align: center;
            width: 300px;
            margin-top:5%;
            margin-left:5%;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
            .gray-button {
                text-align: center;
                background-color: #aaa;
                padding: 6px 12px 10px 12px;
                width: 160px;
                height: 33px;
                color: white;
                border-radius: 6px;
                font-size: 13px;
                font-weight: bold;
            }
	</style>
	<form class="form" action="controller.php?action=add" method="POST" target="_blank">
	    <!-- orders -->
	    <div class="col-lg-5">
	        <div class="col-lg-12">
	            <div class="row">
	                <div class="page-header">
	                    Lista de Ordenes <a href="addorder.php" class="btn-primary btn btn-s" data-toggle="lightbox" data-title="New Order">
	                        <i class="fa fa-plus-circle"></i> Nueva Orden</a>
	                </div>
	                <div id="reload" class="scrollorder">
	                    <table class="table table-bordered table-hover">
	                        <thead>
	                            <tr>
	                                <th>Orden No.</th>
	                                <th>Mesa No.</th>
	                                <th>Mesero</th>
	                                <th>Estado</th>
                                    <th>Servido/despachado</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <?php
                                $remarks = isset($_GET['rem']) ? $_GET['rem'] : "";
                                $query = "SELECT * FROM `tblorders` o , `tblusers` u
                                         WHERE  o.`USERID` = u.`USERID` AND STATUS='Pending' GROUP BY ORDERNO ORDER BY ORDERID ASC ";
                                $mydb->setQuery($query);
                                $cur = $mydb->loadResultList();
                                foreach ($cur as $result) {
                                    if ($result->STATUS_KITCHEN_ID) {
                                       $color = "#ea4646fa";
                                       $text  = 'Pendiente por Servir/Despachar';
                                    }else{
                                       $color = "green";
                                       $text  = 'Despachado/Servido';
                                    }
                                    echo '<tr>';
                                    echo '<td><a style="font-size:15px; font-weight:bold;" href="index.php?view=POS&orderno=' . $result->ORDERNO . '&tableno=' . $result->TABLENO . '&rem=' . $result->REMARKS . '" >' . $result->ORDERNO . '</a></td>';
                                    echo '<td align="center">' . $result->TABLENO . '</td>';
                                    echo '<td>' . $result->FULLNAME . '</td>';
                                    echo '<td>' . $result->REMARKS . '</td>';
                                    echo '  <td style="
                                                font-weight:600;
                                                 background-color: '.$color.'">
                                                ' .  $text . '
                                            </td>';
                                    echo'</tr>';
                                }
                                ?>
	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- end orders -->
	    <!-- SUMARRY -->
	    <div class="col-lg-7" style="border-left: 1px solid #ddd;">
	        <div class="col-lg-12">
	            <!-- order details -->
	            <div class="row">
	                <div style="font-size: 24px;font-weight: bold;margin-top: 10px;">
	                    Detalles de ordenes
	                    <small><?php echo isset($_GET['tableno']) ? " para la mesa N°: " . $_GET['tableno'] : "" ?> <?php echo isset($_GET['rem']) ? "| " . $_GET['rem'] : "" ?></small>
	                    <span><?php echo isset($_GET['orderno']) ?  '<a href="addmeal.php?view=addmeal&orderno=' . $_GET['orderno'] . '&tableno=' . $_GET['tableno'] . '&rem=' . $remarks . '" data-toggle="lightbox" class="btn btn-s btn-primary " data-title="<b>Añadir Plato</b>"><i class="fa fa-plus-circle"> Añadir Plato</i></a>' : ''; ?></span>
	                    <p style="text-align: right;font-size: 20px;">Numero Orden:<b style="text-decoration: underline;">
	                            <?php
                                echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?></b>
	                        <input type="hidden" name="ORDERNO" id="ORDERNO" value="<?php echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?>">
	                        <input type="hidden" name="tableno" id="tableno" value="<?php echo isset($_GET['tableno']) ?  $_GET['tableno'] : "NONE" ?>">
	                        <input type="hidden" name="REMARKS" id="REMARKS" value="<?php echo isset($_GET['rem']) ?  $_GET['rem'] : "" ?>">
	                    </p>
	                </div>
	                <div id="showmeal">
	                    <div class="scrolly">
	                        <table id="table" class="table table-hover" style="font-size: 12px">
	                            <thead>
	                                <tr style="font-size: 15px;">
	                                    <th>Plato</th>
	                                    <th width="60">Precio</th>
	                                    <th width="50" style="text-align: center;">Qty</th>
	                                    <th width="90">Cantidad</th>
	                                    <th width="30">Acciones</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php
                                    $total = 0;
                                    if (isset($_GET['orderno'])) {
                                        # code...
                                        $orderno = $_GET['orderno'];
                                        $query = "SELECT * FROM `tblorders` o , `tblusers` u
	           					 WHERE  o.`USERID` = u.`USERID` AND `STATUS`='Pending' AND `ORDERNO` ='" . $orderno . "'";
                                        $mydb->setQuery($query);
                                        $cur = $mydb->loadResultList();
                                        foreach ($cur as $result) {
                                            $url="index.php?view=POS&orderno=' . $result->ORDERNO . '&tableno=' . $result->TABLENO . '&rem=' . $result->REMARKS . '";
                                            echo '<tr>';
                                            echo '<td style="font-size:15px;">' . $result->DESCRIPTION . '</td>';
                                            echo '<td style="font-size:15px;"><input type="hidden" id="' . $result->ORDERID . 'orderprice" value="' . $result->PRICE . '" >' . number_format($result->PRICE) . '</td>';
                                            echo '
                                                <td style="font-size:15px;">
                                                    <input
                                                        type    = "number"
                                                        min     = "1"
                                                        class   = "orderqty"
                                                        data-id = "'.$result->ORDERID . '"
                                                        id      = "'.$result->ORDERID .'orderqty"
                                                        value   = "'.$result->QUANTITY . '"
                                                        style   = "width:50px"
                                                    >
                                                </td>';
                                            echo '<td style="text-align:center;">
                                                        <output
                                                            style="font-size:15px;padding-top: 0px;"
                                                            id="Osubtot' . $result->ORDERID . '"
                                                        >' . $result->SUBTOTAL. '</output>
                                                </td>';
                                            // echo '<td></td>';
                                            echo '<td style="text-align:center;"><a title="Cancel Order" class="btn btn-xs btn-danger" style="text-decoration:none;" href="controller.php?action=delete&id=' . $result->ORDERID . '&rem=' . $result->REMARKS . '"><i style="font-size:15px; padding:2px;" class="fa fa-trash-o"></i></a></td>';
                                            echo '</tr>';
                                            $total += $result->SUBTOTAL;
                                        }
                                    }
                                    ?>
	                                <!-- <tr>
				  			<td colspan="4"></td>
				  		</tr> -->
	                            </tbody>
	                        </table>
	                    </div>
	                    <!-- <hr/> -->
	                    <!-- end order details -->
	                    <!-- summary -->
	                    <div style="font-size: 19px;font-weight: bold;margin-top:20px;margin-bottom: 3px">
	                        Resumen
	                    </div>
	                    <table class="table table-bordered">
	                        <thead>
	                            <tr>
	                                <th width="250" style="text-align: center;padding-bottom: 27px;">Sub-Total</th>
	                                <th><input class="form-control" type="text" id="totamnt" readonly="true" value="<?php echo number_format($total, 2); ?>">
	                                    <input type="hidden" name="totalamount" id="totalamount" value="<?php echo $total; ?>"></th>
	                            </tr>
	                            <!-- <tr>
                            <tr>
                                <td>
                                    <b style="font-size: 13px;">Persona de descuento(s)</b> <input type="checkbox" id="SENIORCITIZEN" name="SENIORCITIZEN" class="seniorcitizen" value="20">
                                </td>
                                <td>
                                    <input class="form-control" placeholder="Cuantas Personas?" type="number" id="SENIORADDNO" name="SENIORADDNO" style="width: 200px;" disabled="true">
                                     <input class="form-control" placeholder="Senior Id" type="text" id="SENIORID" name="SENIORID" style="width: 200px;margin-top: 5px" disabled="true">
                                </td>
                            </tr> -->
	                            </tr>
	                            <tr>
	                                <th width="250" style="text-align: center;padding-bottom: 27px;">Total + Impuestos</th>
	                                <th>
                                        <input class="form-control" type="text" id="overalltot" readonly="true" value="<?php echo number_format($total, 2); ?>">
	                                    <input type="hidden" name="overalltotal" id="overalltotal" value="<?php echo $total; ?>">
                                    </th>
	                            </tr>
	                            <tr>
	                                <th width="250" style="text-align: center;padding-bottom: 27px;">Pagan Con</th>
	                                <th>
	                                    <input style="display:inline;" type="text" class="form-control" name="tenderamount" id="tenderamount" placeholder="&#36; 0.00" autocomplete="off">
                                        <button type="button"  data-img='true' class="btn btn-primary" data-toggle="modal" data-target="#myModal">Vincular a Cuenta</button>
	                                    <span id="errortrap"></span>
	                                </th>
	                            </tr>
	                            <tr>
	                                <th width="250" style="text-align: center;padding-bottom: 27px;">Cambio</th>
	                                <th><input class="form-control" type="" class="sukli" class="numbers" readonly="true" name="sukli" id="sukli" value="" placeholder="&#36; 0.00"></th>
	                            </tr>
	                        </thead>
	                    </table>
	                    <div class="botones_acciones_pos">
	                        <button target="_blank" type="submit" name="save" class="btn btn-primary btn-lg fa fa-save" id="save">
                                Enviar a cocina
                            </button>
	                        <!-- <a style="margin-top: 10px;" target="_blank" href="tempreceipt.php?orderno=<?php echo isset($_GET['orderno']) ?  $_GET['orderno'] : "NONE" ?>&tableno=<?php echo isset($_GET['tableno']) ?  $_GET['tableno'] : "NONE" ?>" class="btn btn-default btn-lg fa fa-print">
                                <b>Imprimir para cocinar</b>
                            </a> -->
	                    </div>
	                </div>
	                <!-- end summary -->
	            </div>
	        </div>
	</form>
 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cuentas</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>N° CC</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $remarks = isset($_GET['rem']) ? $_GET['rem'] : "";
                    $query = "SELECT * FROM `tblacount` ";
                    $mydb->setQuery($query);
                    // query sum of aocounts
                    $cur = $mydb->loadResultList();
                    foreach ($cur as $result) {
                        $query2 = "SELECT sum_all_orden_acount_owe($result->TABLEID) AS SUM";
                        $mydb->setQuery($query2);
                        $cur2    = $mydb->loadSingleResult();
                        echo '<tr style="cursor: pointer;" data-dismiss="modal" id="'.$result->TABLEID.'" name="'.$result->NAME.'"  onClick="fun(this)">';
                        echo '  <td>
                                      <a style="font-size:15px; font-weight:bold;" href ="index.php?view=POS&orderno=' . $result->TABLEID . '&tableno=' .  $result->TABLEID . '&rem=' . $result->TABLEID . '" >'.$result->ID_NUMBER.'</a></td>';
                        echo '  <td align="center">' . $result->NAME . '</td>';
                        echo '  <td>$ ' . number_format($cur2->SUM) . '</td>';
                        echo '</td>';

                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
	<script>
        function fun(params) {
            console.log(params.name);

	        tenderamount = document.getElementById("tenderamount");

            tenderamount.value="Cuenta enlazada: beri";
        }

	    function SearchTable() {
	        // Declare variables
	        var input, filter, table, tr, td, i;
	        input  = document.getElementById("myInput");
	        filter = input.value.toUpperCase();
	        table  = document.getElementById("dashtable");
	        tr     = table.getElementsByTagName("tr");
	        td     = table.getElementsByTagName("td");
	        // Loop through all table rows, and hide those who don't match the search query
	        for (i = 0; i < tr.length; i++) {
	            td = tr[i].getElementsByTagName("td")[0];
	            if (td) {
	                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	                    tr[i].style.display = "";
	                } else {
	                    tr[i].style.display = "none";
	                }
	            }
	        }
	    }
	</script>