
<?php

require_once("../modelos/ventas.php");
require_once("../modelos/Clientes.php");

$client = new CLientes();
$sold = new Ventas();


//$venta=$sold->get_venta_por_fecha($_POST["cedula"],$_POST["datepicker"],$_POST["datepicker2"]);
//$cliente=$client->get_cliente_por_id($_POST["cedula"]);

$venta=$sold->get_detalles_factura(12);
$cliente=$client->get_cliente_por_id(20323878);
?>

<style type="text/css">

    
.Estilo1{
  font-size: 13px;
  font-weight: bold;
}
table{
  margin-top: 20%;
}
.Estilo2{font-size: 13px}
.Estilo3{font-size: 13px; font-weight: bold;}
.Estilo4{color: #FFFFFF}
.Estilo_prueba{
  background-color: #878e96;
}

</style>
   
<table width="101%" class="change_order_items">

  <tr>
    <th width="5%" bgcolor="#317eac"><span class="Estilo11">CEDULA</span></th>
    <th width="15%" bgcolor="#317eac"><span class="Estilo11">NOMBRES</span></th>
    <th width="12%" bgcolor="#317eac"><span class="Estilo11">TELEFONO</span></th>
    <th width="38%" bgcolor="#317eac"><span class="Estilo11">DIRECCIÓN</span></th>
    <th width="30%" bgcolor="#317eac"><span class="Estilo11">CORREO</span></th>
  </tr>

    <?php
      
      for($i=0;$i<sizeof($cliente);$i++){

    ?>

    <tr style="font-size:10pt" class="even_row">
    <td><div><span class=""><?php echo $cliente[$i]["cedula"];?></span></div></td>
    <td style="text-align: center"><div><span class=""><?php echo $cliente[$i]["nombre"]." ".$cliente[$i]["apellido"];?></span></div></td>
    <td style="text-align: center"><div><span class=""><?php echo $cliente[$i]["telefono"];?></span></div></td>
    <td style="text-align: right"><div><span class=""><?php echo $cliente[$i]["direccion"];?></span></div></td>
    <td style="text-align:center"><div><span class=""><?php echo $cliente[$i]["correo"];?></span></div></td>
    </tr>

    <?php
      }
    ?>

    </table>
</div>

<table class="" width="100%" id="">
                      <thead>
                        <tr class="Estilo_prueba">
                          <th class="all text-center">Concepto o Descripcion</th>
                          <th class="min-desktop">USD $</th>
                           <th class="all">Precio Venta Bs.</th>
                          <th class="min-desktop">IVA 16%</th>
                          <th class="all">Cantidad</th>
                         <!-- <th class="all">Total Bs</th>
                          <th class="all">Total $</th>    -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      for($i=0;$i<sizeof($venta);$i++){

                    ?>

                    <tr style="font-size:10pt" class="even_row">
                    <td><div><span class=""><?php echo $venta[$i]["idFactura"];?></span></div></td>
                    <td style="text-align: center"><div><span class=""><?php echo $venta[$i]["Nombre"];?></span></div></td>
                     <td style="text-align: center"><div ><span class=""><?php echo $venta[$i]["precio"];?></span></div></td>
                    <td style="text-align: right"><div ><span class=""><?php echo $venta[$i]["tasa"];?></span></div></td>
                    <td style="text-align:center"><div ><span class=""><?php echo $venta[$i]["nombre"];?></span></div></td> 
                    </tr>

                    <?php
                      }
                    ?>
                      </tbody>
                    </table>
