<?php

require_once("../modelos/Clientes.php");
require_once("../modelos/ventas.php");
require_once("../modelos/Servicios.php");


$client = new CLientes();
$sold = new Ventas();

$venta=$sold->get_detalles_factura($_POST["idFactura"]);
$cliente=$client->get_cliente_por_id($_POST["cedula"]);

ob_start();

?>

<link type="text/css" rel="stylesheet" href="dompdf/css/print_static.css"/>



<style type="text/css">
.text-center{
  text-align: center;

}
    
.Estilo1{
  font-size: 13px;
  font-weight: bold;
}
.margen {
  margin-top:  12%;
  margin-left: 80%
}
table{
  margin-top: 4%;
  border-collapse: collapse;
}

table, th, td{
  border: 1px solid black;
}

th,td{
  padding: 5px;
}

.Estilo2{font-size: 13px}
.Estilo3{font-size: 13px; font-weight: bold;}
.Estilo4{color: #FFFFFF}
.Estilo_prueba{
  /*background-color: #878e96; */
  background-color: #748290;
}

</style>


  <div > 
            <div class="margen">
              <label>Factura:</label>
              <label id="idFactura"><?php echo "00".$_POST["idFactura"];?></label>
            </div>
            <div style="display: inline-block">
              <label style="margin-top: 50%">Nombre o Razon Social:</label>
              <label id="nombre_c"><?php echo $cliente[0]["nombre"]." ".$cliente[0]["apellido"];?></label>
            </div>
            <div style="display: inline-block">
            <label style="margin-left: 15%">RIF / CI:</label>
              <label id="idCliente"><?php echo $cliente[0]["cedula"]?></label>
            </div>
            <div>
              <label>Domicilio Fiscal:</label>
              <label id="direccion"><?php echo $cliente[0]["direccion"]?></label>
            </div>
            <div style="display: inline-block">
                <label style="margin-left: 15%">Telefono:</label>
                <label id="telefono"><?php echo $cliente[0]["telefono"]?></label>
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

<table  class="" width="100%" id="">
                      <thead>
                        <tr class="Estilo_prueba">
                          <th class="text-center">Cant</th>
                          <th class="text-center">Concepto o Descripcion</th>
                          <!-- <th class="text-center">USD $</th> -->
                           <th class="text-center">Precio Venta Bs.</th>
                          <th class="text-center">Total</th>
                         <!-- <th class="all">Total Bs</th>
                          <th class="all">Total $</th>    -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      for($i=0;$i<sizeof($venta);$i++){

                    ?>

                    <tr style="font-size:10pt" class="even_row">
                    <td style="text-align:center"><div><span class=""><?php echo $venta[$i]["cantidad"];?></span></div></td>
                    <td style="text-align:left"><div><span class=""><?php echo $venta[$i]["Nombre"];?></span></div></td>
                    <!-- <td style="text-align:center"><div ><span class=""><?php echo $venta[$i]["precio"];?></span></div></td> -->
                    <td style="text-align:right"><div ><span class=""><?php echo $venta[$i]["tasa"]*$venta[$i]["precio"];?></span></div></td>
                    <td style="text-align:right"><div ><span class=""><?php echo $venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"];?></span></div></td> 
                    </tr>

                    <?php
                      }
                    ?>
                      </tbody>
                    </table>


<?php

$salida_html = ob_get_contents();
ob_end_clean();

// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;
// Introducimos HTML de prueba
  
 //$html=file_get_contents_curl("http://computenser.test/computenser/report/factura.php");

$options = new Options();
$options->set('isPhpEnable','true');
 
// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF($options);
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->set_paper("letter", "portrait");
//$pdf->set_paper(array(0,0,104,250));
 
//Fondo o Marca de agua
$canvas = $pdf->getCanvas();

$w = $canvas->get_width();
$h = $canvas->get_height();

//$imagenUrl = '../public/images/perfil-avatar-mujer-icono-redondo_24640-14042.jpg';
$imagenUrl = 'formato.jpg';
$imgwidth = 612;
$imgHeight = 792;

//$canvas->set_opacity(.5);

$x=(($w-$imgwidth)/2);
$y=(($h-$imgHeight)/2);

$canvas->image($imagenUrl,$x,$y,$imgwidth,$imgHeight);
//fin de fondo o marca de agua


// Cargamos el contenido HTML.
$pdf->load_html($salida_html);;
 
// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('ePdf.pdf',array("Attachment"=>0));
//$pdf->loadView('f', compact('values'));
//return $pdf->stream();
///echo '<script>window.open("crearPdf.php", "_blank");</script>';

/* 
function file_get_contents_curl($url) {
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
} */

?>