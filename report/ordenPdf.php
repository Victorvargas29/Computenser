<?php

//require_once("../modelos/Clientes.php");
require_once("../modelos/ordenes.php");
require_once("../modelos/Servicios.php");



//$client = new CLientes();
$ordenes = new Ordenes();
//$tipo = $sold->consulta_estado();

if(isset($_POST['numDoc'])){
  $orden=$ordenes->reporte_orden($_POST["numDoc"]);
  $detalles=$ordenes->detalles_reporte_orden($_POST["numDoc"]);
  $numDoc=$_POST["numDoc"];
}else{
  $orden=$ordenes->reporte_orden($_GET["numDoc"]);
  $detalles=$ordenes->detalles_reporte_orden($_GET["numDoc"]);
  $numDoc=$_GET["numDoc"];
}

$subtotal=0;
$iva=0;
$total=0;
$sub_dolar=0;
$iva_dolar=0;
$total_dolar=0;

ob_start();

?>

<link type="text/css" rel="stylesheet" href="dompdf/css/print_static.css"/>



<style type="text/css">

html{
  font-family: "Helvetica", normal;
  font-size: 150%;
}
.text-center{
  text-align: center;

}

.text-derecha{
 text-align: right;
 /* direction: rtl; */
}

.text-izquierda{
 text-align: left;
  /* direction: ltr; */
}

.EstiloFactura{
  font-family: "Courier", bold;
  font-size: 14px;
  font-weight: bold;
  color: #ea1717
}
.margen {
  margin-top:  11%;
  margin-left: 80%
}
.totales {
 /* margin-top:  12%;  */
  margin-left: 60%
}
table{
  margin-top: 4%;
  border-collapse: collapse;
}

table{
 /* border: 0.5px solid black; */
}

span, label{
  text-align: right;
  direction: rtl;
}

th,td{
  padding: 5px;
  height: 15px;
}

label{
  font-size: 12px;
}

.Estilo2{font-size: 12px}
.Estilo3{font-weight: bold;}
.Estilo4{color: #FFFFFF}
.Estilo_color{
  background-color: #a4a7a9;
}

</style>


  <div > 
            <div class="margen">
              <label class="Estilo2">Orden N°:</label>
              <label class="EstiloFactura" id="i"><?php echo "000".$numDoc;?></label>
            </div>
            <div class="" style="display: inline-block">
              <label class="Estilo3" style="margin-top: 50%">NOMBRE O RAZON SOCIAL:</label>
              <label id=""><?php echo $orden[0]["cliente_nom"]." ".$orden[0]["apellido"];?></label>
            </div>
            <div style="display: inline-block">
            <label class="Estilo3" style="margin-left: 15%">RIF / CI:</label>
              <label id=""><?php echo $orden[0]["cedula"]?></label>
            </div>
            <div>
              <div style="display: inline-block">
                <label class="Estilo3">DOMICILIO FISCAL:</label>
                <label id=""><?php echo $orden[0]["direccion"]?></label>
              </div>
              <div style="display: inline-block">
                  <label class="Estilo3" style="margin-left: 25%">TELEFONO:</label>
                  <label id=""><?php echo $orden[0]["telefono"]?></label>
                  <br/>
              </div>
              <div style="display: inline-block">
                <label class="Estilo3" style="margin-left: 30%">FECHA:</label>
                <label id="">
                  <?php
                    $date = new DateTime($orden[0]["fecha"]);
                    // echo $date->format('d-m-Y');
                  ?>
                </label>
              </div>
            </div>
            
    </div>
    <div > 
            <div class="" style="display: inline-block">
              <label class="Estilo3" style="margin-top: 50%">PLACA:</label>
              <label id=""><?php echo $orden[0]["placa"];?></label>
            </div>
            <div style="display: inline-block">
              <label class="Estilo3" style="margin-left: 15%"> Estado de Orden:</label>
              <label id=""><?php echo $orden[0]["estatus"]?></label>
            </div>            
    </div>
   
<table  class="" width="100%" id="">
                      <thead>
                        <tr class="Estilo2">
                          
                          <th class="text-izquierda">CONCEPTO O DESCRIPCION</th>
                         <!--  <th class="text-derecha">Empleado</th> -->
                          <th class="text-derecha">PRECIO</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      for($i=0;$i<sizeof($detalles);$i++){

                    ?>

                    <tr style="font-size:10pt" class="even_row">
                      <td style="text-align:left"><div><span class=""><?php echo $detalles[$i]["servicio_n"]."--".$detalles[$i]["descripcion"];?></span></div></td>
                      <!-- <td style="text-align:center"><div><span class=""> <?php // echo $orden[$i]["e_nombre"];?></span></div></td> -->
                      <td style="text-align:center"><div ><span class=""><?php echo $detalles[$i]["precio"];?></span></div></td>
                      
                    </tr>

                    <?php
                      }
                   for($i=0;$i<20-sizeof($detalles);$i++){
                   ?>

                    <tr style="" >
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                    </tr>
                <?php
                   }
                ?>
                      </tbody>
  </table>
   

                      <?php
                        for($i=0;$i<sizeof($detalles);$i++){

                          $subtotal=$detalles[$i]["precio"]+$subtotal;
                        }
                    ?>
                       
          <div style="float:left">
            <label >A SOLO EFECTO DE LO PREVISTO EN EL ARTICULO 25<BR>
              DE LA LEY DE IMPUESTO DE VALOR AGREGADO SE<BR>
            EXPRESAN LOS MONTOS DE LA ORDEN EN BsS.<BR>
            CALCULADO A LA TASA DE CAMBIO POR BCV DE<BR>
          1 USD POR BsS.</label>
          </div>


          <div class="">  
              <div class="totales">
                  <label style="text-align:left" class="Estilo2">TOTAL<?php 
                    echo " Bs.";
                  ?></label>
                  <label style="float:right; margin-top: 7%" class="" id="subtotal"><?php
                        echo $subtotal;
                        ?></label>
              </div>  
          </div>

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

// Cargamos el contenido HTML.
$pdf->load_html($salida_html);;
 
// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('Orden000'.$numDoc.'.pdf',array("Attachment"=>0));
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