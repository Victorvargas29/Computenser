<?php
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
              <label class="EstiloFactura" id="i"><?php echo "000";?></label>
            </div>
            <div class="" style="display: inline-block">
              <label class="Estilo3" style="margin-top: 50%">NOMBRE O RAZON SOCIAL:</label>
            
            </div>
            <div style="display: inline-block">
            <label class="Estilo3" style="margin-left: 15%">RIF / CI:</label>
             
            </div>
            <div>
              <div style="display: inline-block">
                <label class="Estilo3">DOMICILIO FISCAL:</label>
                
              </div>
              <div style="display: inline-block">
                  <label class="Estilo3" style="margin-left: 25%">TELEFONO:</label>
                  
                  <br/>
              </div>
              <div style="display: inline-block">
                <label class="Estilo3" style="margin-left: 30%">FECHA:</label>
                <label id="">
                  <?php
                 
                  ?>
                </label>
              </div>
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



// Cargamos el contenido HTML.
$pdf->load_html($salida_html);;
 
// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('factura00.pdf',array("Attachment"=>0));
//$pdf->loadView('f', compact('values'));
//return $pdf->stream();
///echo '<script>window.open("crearPdf.php", "_blank");</script>';



?>