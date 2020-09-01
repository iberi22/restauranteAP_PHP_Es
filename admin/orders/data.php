<?php
require_once("../../include/initialize.php");
if(isset($_POST['orderlist'])){
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Orden No.</th>
            <th>Mesa No.</th>
            <th>Quien Atendio</th>
            <th>Estado</th>
            <th>Servido/despachado</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM `tblorders` o , `tblusers` u
                 WHERE  o.`USERID` = u.`USERID` AND STATUS='Pending' GROUP BY ORDERNO  ORDER BY ORDERID ASC";
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList();
            foreach ($cur as $result) {
                 if ($result->STATUS_KITCHEN) {
                    $color = "#ea4646fa";
                    $text  = 'Pendiente por Servir/Despachar';
                }else{
                    $color = "green";
                    $text  = 'Despachado/Servido';
                }
                echo '<tr>';
                echo '  <td>
                            <a style="font-size:15px;font-weight:bold;" href="index.php?view=POS&orderno='.$result->ORDERNO.'&tableno='.$result->TABLENO.'&rem='.$result->REMARKS.'" >'.$result->ORDERNO.'</a>
                        </td>';
                echo '<td align="center">'.$result->TABLENO.'</td>';
                echo '<td>'.$result->FULLNAME.'</td>';
                echo '<td>'.$result->REMARKS.'</td>';
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
<?php }
if(isset($_POST['msg'])){
       $query = "SELECT * FROM `tblorders`
             WHERE  STATUS='Pending' GROUP BY ORDERNO ";
        $mydb->setQuery($query);
        $cur = $mydb->executeQuery();
        $maxrow = $mydb->num_rows($cur);
        echo $maxrow;
}
?>
