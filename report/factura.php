
<?php
// if(S_SERVER["REQUEST_METHOD"=="POST"]){
// 	echo 'factura'.S_POST['idFactura'];
// }
require_once("../modelos/ventas.php");
require_once("../modelos/Clientes.php");

$client = new CLientes();
$sold = new Ventas();


//$venta=$sold->get_venta_por_fecha($_POST["cedula"],$_POST["datepicker"],$_POST["datepicker2"]);
//$cliente=$client->get_cliente_por_id($_POST["cedula"]);
$idfact=$sold->Max2();
$venta=$sold->get_detalles_factura($idfact);
$cliente=$client->get_cliente_por_id(25135123);
?>

<style type="text/css">

    
.Estilo1{
  font-size: 13px;
  font-weight: bold;
}
.margen {
  margin-top: 12%;
  margin-left: 80%
}
table{
  margin-top: 4%;
}
.Estilo2{font-size: 13px}
.Estilo3{font-size: 13px; font-weight: bold;}
.Estilo4{color: #FFFFFF}
.Estilo_prueba{
  background-color: #878e96;
}

</style>


  <div > 
            <div class="margen">
              <label>Factura:</label>
              <label id="idFactura">001654</label>
            </div>
            <div style="display: inline-block">
              <label style="margin-top: 50%">Nombre o Razon Social:</label>
              <label id="nombre_c"><?php echo $cliente[0]["nombre"]." ".$cliente[0]["apellido"];?></label>
            </div>
            <div  style="display: inline-block">
            <label style="margin-left: 15%">RIF / CI:</label>
              <label id="idCliente"></label>
            </div>
            <div>
              <label>Domicilio Fiscal:</label>
              <label id="direccion"></label>
            </div>
            <div>
                <label>Telefono:</label>
                <label id="telefono"></label>
                <br/>
            </div>
    </div>
   
<!-- <table width="101%" class="change_order_items">
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
</div> -->

<table class="" width="100%" id="">
                      <thead>
                        <tr class="Estilo_prueba">
                          <th class="all text-center">Cant</th>
                          <th class="all text-center">Concepto o Descripcion</th>
                          <th class="min-desktop">USD $</th>
                           <th class="all">Precio Venta Bs.</th>
                          <th class="all">Total</th>
                         <!-- <th class="all">Total Bs</th>
                          <th class="all">Total $</th>    -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      for($i=0;$i<sizeof($venta);$i++){

                    ?>

                    <tr style="font-size:10pt" class="even_row">
                    <td style="text-align:center"><div><span class=""><?php echo $venta[$i]["idFactura"];?></span></div></td>
                    <td style="text-align:left"><div><span class=""><?php echo $venta[$i]["Nombre"];?></span></div></td>
                    <td style="text-align:center"><div ><span class=""><?php echo $venta[$i]["precio"];?></span></div></td>
                    <td style="text-align:right"><div ><span class=""><?php echo $venta[$i]["tasa"]*$venta[$i]["precio"];?></span></div></td>
                    <td style="text-align:right"><div ><span class=""><?php echo $venta[$i]["tasa"]*$venta[$i]["precio"]*2;?></span></div></td> 
                    </tr>

                    <?php
                      }
                    ?>
                      </tbody>
                    </table>
