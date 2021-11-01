<?php

//require_once("../modelos/Clientes.php");
require_once("../modelos/ventas.php");
require_once("../modelos/Servicios.php");



//$client = new CLientes();
$sold = new Ventas();
//$tipo = $sold->consulta_estado();

if(isset($_POST['idFactura'])){
  $Factura_anulado = $sold->get_venta_idfactura($_POST["idFactura"]);
  $venta=$sold->get_detalles_factura($_POST["idFactura"]);
  $idFacturas=$_POST["idFactura"];
  $moneda=$_POST["moneda"];
}else{
  $Factura_anulado = $sold->get_venta_idfactura($_GET["idFactura"]);
  $venta=$sold->get_detalles_factura($_GET["idFactura"]);
  $idFacturas=$_GET["idFactura"];
  $moneda=$venta[0]["tipo_moneda"];
}
//$cliente=$client->get_cliente_por_id($_POST["cedula"]);


$subtotal=0;
$iva=0;
$total=0;
$sub_dolar=0;
$iva_dolar=0;
$total_dolar=0;

/* $venta=$sold->get_detalles_factura(12);
$cliente=$client->get_cliente_por_id(25135123); */

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
              <label class="Estilo2">FACTURA N°:</label>
              <label class="EstiloFactura" id="i"><?php echo "000".$idFacturas;?></label>
            </div>
            <div class="" style="display: inline-block">
              <label class="Estilo3" style="margin-top: 50%">NOMBRE O RAZON SOCIAL:</label>
              <label id=""><?php echo $venta[0]["nombre"]." ".$venta[0]["apellido"];?></label>
            </div>
            <div style="display: inline-block">
            <label class="Estilo3" style="margin-left: 15%">RIF / CI:</label>
              <label id=""><?php echo $venta[0]["cedula"]?></label>
            </div>
            <div>
              <div style="display: inline-block">
                <label class="Estilo3">DOMICILIO FISCAL:</label>
                <label id=""><?php echo $venta[0]["direccion"]?></label>
              </div>
              <div style="display: inline-block">
                  <label class="Estilo3" style="margin-left: 25%">TELEFONO:</label>
                  <label id=""><?php echo $venta[0]["telefono"]?></label>
                  <br/>
              </div>
              <div style="display: inline-block">
                <label class="Estilo3" style="margin-left: 30%">FECHA:</label>
                <label id="">
                  <?php
                    $date = new DateTime($venta[0]["fecha"]);
                    echo $date->format('d-m-Y');
                  ?>
                </label>
              </div>
            </div>
            
    </div>
    <div > 
            <div class="" style="display: inline-block">
              <label class="Estilo3" style="margin-top: 50%">PLACA:</label>
              <label id=""><?php echo $venta[0]["placa"];?></label>
            </div>
            <div style="display: inline-block">
              <label class="Estilo3" style="margin-left: 15%"> O / E:</label>
              <label id=""><?php echo $venta[0]["oentrega"]?></label>
            </div>            
    </div>
   
<!-- 
<div>  
  <table style="margin-top: 12%" width="101%" class="change_order_items">
    <tr>
      <th width="5%" bgcolor="#317eac"><span class="Estilo11">CEDULA</span></th>
      <th width="15%" bgcolor="#317eac"><span class="Estilo11">NOMBRES</span></th>
      <th width="12%" bgcolor="#317eac"><span class="Estilo11">TELEFONO</span></th>
      <th width="38%" bgcolor="#317eac"><span class="Estilo11">DIRECCIÓN</span></th>
      <th width="30%" bgcolor="#317eac"><span class="Estilo11">CORREO</span></th>
    </tr>
    <?php
     // for($i=0;$i<sizeof($cliente);$i++){
    ?>
      <tr style="font-size:10pt" class="even_row">
        <td><div><span class=""><?php //echo $cliente[$i]["cedula"];?></span></div></td>
        <td style="text-align: center"><div><span class=""><?php //echo $cliente[$i]["nombre"]." ".$cliente[$i]["apellido"];?></span></div></td>
        <td style="text-align: center"><div><span class=""><?php //echo $cliente[$i]["telefono"];?></span></div></td>
        <td style="text-align: right"><div><span class=""><?php //echo $cliente[$i]["direccion"];?></span></div></td>
        <td style="text-align:center"><div><span class=""><?php //echo $cliente[$i]["correo"];?></span></div></td>
      </tr>
    <?php
     // }
    ?>
  </table>
</div>
 -->
<table  class="" width="100%" id="">
                      <thead>
                        <tr class="Estilo2">
                          
                          <th class="text-izquierda">CONCEPTO O DESCRIPCION</th>
                          
                          <th class="text-center">CANT</th>
                          <!-- <th class="text-center">USD $</th> -->
                           <th class="text-derecha">PRECIO UNITARIO</th>
                          <th class="text-derecha">TOTAL</th>
                         <!-- <th class="all">Total Bs</th>
                          <th class="all">Total $</th>    -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      
                      for($i=0;$i<sizeof($venta);$i++){

                    ?>

                    <tr style="font-size:10pt" class="even_row">
                      <td style="text-align:left"><div><span class=""><?php echo $venta[$i]["Nombre"]."--".$venta[$i]["descripcion"];?></span></div></td>
                      <td style="text-align:center"><div><span class=""><?php echo $venta[$i]["cantidad"];?></span></div></td>
                      <!-- <td style="text-align:center"><div ><span class=""><?php echo number_format($venta[$i]["precio"],2);?></span></div></td> -->
                      <td style="text-align:right"><div ><span class=""><?php 
                      if(isset($moneda)){
                        if($moneda==0){
                          echo number_format($venta[$i]["tasa"]*$venta[$i]["precio"],2);
                         }else{
                          echo number_format($venta[$i]["precio"],2);
                        }
                      }else{
                        echo number_format($venta[$i]["tasa"]*$venta[$i]["precio"],2);
                      }?></span></div></td>
                      
                      <td style="text-align:right"><div ><span class=""><?php 
                        if(isset($moneda)){
                          if($moneda==0){
                            echo number_format($venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"],2);
                          }else{
                            echo number_format($venta[$i]["precio"]*$venta[$i]["cantidad"],2);
                          }
                        }else{
                          echo number_format($venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"],2);
                        }?></span></div></td>
                    </tr>

                    <?php
                      }
                   for($i=0;$i<20-sizeof($venta);$i++){
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
                        for($i=0;$i<sizeof($venta);$i++){

                          $subtotal=($venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"])+$subtotal;
                          $iva=($venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"]* 0.16)+$iva;
                          $total=($venta[$i]["tasa"]*$venta[$i]["precio"]*$venta[$i]["cantidad"]* 1.16)+$total;

                          $sub_dolar=($venta[$i]["precio"]*$venta[$i]["cantidad"])+$sub_dolar;
                          $iva_dolar=($venta[$i]["precio"]*$venta[$i]["cantidad"]* 0.16)+$iva_dolar;
                          $total_dolar=($venta[$i]["precio"]*$venta[$i]["cantidad"]* 1.16)+$total_dolar;
                        }
          if(isset($moneda)){
            if($moneda==1){
                    ?>
          
                       
          <div style="float:left">
            <label >A SOLO EFECTO DE LO PREVISTO EN EL ARTICULO 25<BR>
              DE LA LEY DE IMPUESTO DE VALOR AGREGADO SE<BR>
            EXPRESAN LOS MONTOS DE LA FACTURA EN BsS.<BR>
            CALCULADO A LA TASA DE CAMBIO POR BCV DE<BR>
          1 USD POR BsS. <?php echo number_format($venta[0]["tasa"],2);?></label>
          </div>
            <?php }
                }
             ?>


          <div class="">  
              <div class="totales">
                  <label style="text-align:left" class="Estilo2">SUBTOTAL<?php if($moneda==0){
                    echo " Bs.";
                  }else{ echo " USD";
                  }?></label>
                  <label style="float:right; margin-top: 7%" class="" id="subtotal"><?php
                    if(isset($moneda)){
                      if($moneda==0){
                        echo number_format($subtotal,2);
                       }else{
                        echo number_format($sub_dolar,2);
                      }
                    }else{
                      echo number_format($subtotal,2);
                    } ?></label>
              </div>
              
              <div class="totales">
                <label style="text-align:left" class="Estilo2">IVA 16% <?php if($moneda==0){
                    echo " Bs.";
                  }else{ echo " USD";
                  }?></label>
                <label style="float:right; margin-top: 8%" class="" id="iva"><?php 
                    if(isset($moneda)){
                      if($moneda==0){
                        echo number_format($iva,2);
                       }else{
                        echo number_format($iva_dolar,2);
                      }
                    }else{
                      echo number_format($iva,2);
                    }?>
              </div>

              <div class="totales">
                <label style="text-align:left" class="Estilo2 Estilo3">TOTAL A PAGAR<?php if($moneda==0){
                    echo " Bs.";
                  }else{ echo " USD";
                  }?></label>
                <label style="float:right; margin-top: 9%" class="" id="total"><?php 
                 if(isset($moneda)){
                  if($moneda==0){
                    echo number_format($total,2);
                   }else{
                    echo number_format($total_dolar,2);
                  }
                }else{
                  echo number_format($total,2);
                }
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

 if($Factura_anulado[0]["anulado"]==1){
//Fondo o Marca de agua
$canvas = $pdf->getCanvas();

$w = $canvas->get_width();
$h = $canvas->get_height();

//$imagenUrl = '../public/images/perfil-avatar-mujer-icono-redondo_24640-14042.jpg';
$imagenUrl = 'anulada.jpg';
$imgwidth = 612;
$imgHeight = 792;

$canvas->set_opacity(.7);

$x=(($w-$imgwidth)/2);
$y=(($h-$imgHeight)/2);

$canvas->image($imagenUrl,$x,$y,$imgwidth,$imgHeight);
//fin de fondo o marca de agua
}else{

}

// Cargamos el contenido HTML.
$pdf->load_html($salida_html);;
 
// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('factura00'.$idFacturas.'.pdf',array("Attachment"=>0));
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