<?php


// Cargamos la librería dompdf que hemos instalado en la carpeta dompdf
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;
// Introducimos HTML de prueba

 $html=file_get_contents_curl("http://computenser.test/computenser/report/factura.php");

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
$pdf->load_html($html);;
 
// Renderizamos el documento PDF.
$pdf->render();

// Enviamos el fichero PDF al navegador.
$pdf->stream('ePdf.pdf',array("Attachment"=>0));
//$pdf->loadView('f', compact('values'));
//return $pdf->stream();
///echo '<script>window.open("crearPdf.php", "_blank");</script>';


function file_get_contents_curl($url) {
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}