  <?php
  require_once("../../include/initialize.php");
   //admin_confirm_logged_in();
  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect("../admin/login.php");
     }

      $orderno = isset($_GET['orderno']) ? $_GET['orderno'] : '';
      $tableno = isset($_GET['tableno']) ? $_GET['tableno'] : '';
      // $printeddate =  date('M-d-Y');

    // $query = "SELECT * FROM `tblpayments` WHERE  `ORDERNO` ='".$orderno."'";
    // $mydb->setQuery($query);
    // $cur = $mydb->loadSingleResult();

    // $customer = $cur->CUSTOMER;
    // $tableno  = $cur->TABLENO;
    // $username = $cur->USERSNAME;
    // $remarks =  $cur->REMARK;
  ?>
  <style type="text/css">
      @page { size: auto;  margin: 0; }
  </style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Ordenes</title>


 <!-- Bootstrap Core CSS -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="../admin/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="../admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!--<link rel="icon" href="../favicon-1.ico" type="image/x-icon"> -->

</head>

<body onload="window.print();" style="width: 100%;padding: 0px;margin: 0px;">
 <style type="text/css">
.tables {
    width: 100%;
    font-size: 8px;
    padding: 0;
}
.tables > tr > td {
    margin-bottom: 25px;

}
 .tables > tr > td {
  border: 0px ;
  padding: 0;
}
 </style>
 <center>
<div id="wrapper">
    <div class="container">
        <div style="text-align: center;font-size: 10px;"><?php
                $query = "SELECT * FROM `tbltitle` WHERE TItleID=1";
                $res = mysql_query($query) or die(mysql_error());
                $viewTitle = mysql_fetch_assoc($res);
                echo $viewTitle['Title'];
            ?></title></div>
        <div style="text-align: center;font-size: 10px;">Lista de ordenes</div>
<!--         <div style="text-align: center;font-size: 8px; margin-bottom: 10px;"><?php echo $remarks; ?></div> -->
    <table class="tables">
        <tr style="border-bottom: .5px solid;padding-bottom:  2px;padding-top: 2px; font-size: 20px;">
            <td colspan="3" align="center">Mesa No: <?php echo $tableno; ?></td>
        </tr>
        <tr style="border-bottom: .2px solid;padding: 5px; margin-top: 10px;">
            <td width="30px;" style="font-size: 10px; font-weight: bold; margin-right: 5px; padding-top: 5px; padding-bottom: 5px;">Qty</td>
            <td width="130px" style="font-size: 10px; font-weight: bold; padding-top: 5px; padding-bottom: 5px;">Descripcion</td>
            <!-- <td align="right">Amount</td> -->
        </tr>
        <?php
                        $total = 0;
                        $tableno = 0;
                        $vat=0;
                        $vatable = 0;
                        $regbill = 0;
                        $waiter="";
                        $senior=0;
                        $totdiscount=0;
                            if (isset($_GET['orderno'])) {
                                # code...

                                $orderno = $_GET['orderno'];
                                $query = "SELECT * FROM `tblorders` o , `tblusers` u
                                 WHERE  o.`USERID` = u.`USERID` AND `ORDERNO` ='".$orderno."'";
                                $mydb->setQuery($query);
                                $cur = $mydb->loadResultList();

                                foreach ($cur as $result) {
                                echo '<tr>';
                                echo '<td style="font-size:15px; font-weight:bold; padding-top:5px; padding-bottom:5px; text-align:center;">'.$result->QUANTITY.'</td>';
                                echo '<td style="font-size:10px; margin-top: 10px; padding-top:5px;
                                padding-bottom:5px;">'.$result->DESCRIPTION.'</td>';
                                // echo '<td align="right">'.$result->SUBTOTAL.'</td>';
                                echo '</tr>';

                                $total += $result->SUBTOTAL;
                                $tableno = $result->TABLENO;

                                $vat = $total * 0.12;

                                    $waiter = $result->FULLNAME;

                                }

                                $vatable = $total - $vat;

                                $regbill = $vatable + $vat;
                            }

                        ?>

  <tr  >
            <td  colspan="2" style="border-top: .5px solid;padding-bottom:  2px;padding-top:10px;"></td>
        </tr>
                         <?php
                            // $summary = New Summary();
                            // $res     = $summary->single_summary($orderno);
                            // $senior =   $res->DISCOUNTSENIOR;

                            ?>
                        <!-- summary -->




                        <!--<tr>
                            <td colspan="2">Gross Charge </td>
                             <td  align="right"  style="border-bottom: .5px dashed" ><?php echo number_format($total,2); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo $waiter; ?></td>
                            <td></td>
                            <td><?php echo $_SESSION['ADMIN_FULLNAME']; ?></td>

                            </tr >
                           <tr>
                            <td style="border-top: .5px dashed;"><?php echo 'Cater'; ?></td>
                            <td></td>
                            <td style="border-top: .5px dashed;"><?php echo 'Cashier'; ?></td>

                            </tr > -->


    </table>
    </div>

</div>
    <!-- /#wrapper -->


<!-- jQuery -->
<script src="../admin/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../admin/js/bootstrap.min.js"></script>

<script src="../admin/js/jquery.dataTables.min.js"></script>
<script src="../admin/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="../js/bootstrap-datepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>

<script type="text/javascript" src="../admin/js/janobe.js" charset="UTF-8"></script>

    <script type="text/javascript">
    (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
        // console.log('Functionality to run after printing');
        // window.print();
        // window.close();
        window.location = "index.php";
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());
</script>
 </center>
</body>
</html>