<?php

require_once "../../../controllers/boletos.controller.php";
require_once "../../../models/boletos.model.php";


class imprimirFactura{

public $id;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];
$id = $this->id;
$item='id';
$boletos = BoletosController::ctrMostrarBoleto($item, $id);
// var_dump(json_encode($boletos));
$serial=$boletos['correlativo'];
$fecha=$boletos['created_at'];
$cliente=$boletos['cliente'];
$tipoD=$boletos['tipo_doc'];
$nDoc=$boletos['documento'];
$paisS=$boletos['pais_s'];
$estadoS=$boletos['estado_s'];
$paisD=$boletos['pais_d'];
$estadoD=$boletos['estado_d'];
$rutaSalida=$boletos['fecha_s'];
$costo=$boletos['costo'];
$iso=$boletos['iso'];
$simbolo=$boletos['simbolo'];
$sa=$boletos['sa'];
//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$medidas = array(80, 120);
// $pdf = new TCPDF('P', 'mm', $medidas, true, 'UTF-8', false);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', $medidas );

//---------------------------------------------------------
$pdf->Image('../../../views/img/logo-ticket.png', 12, 3,0, 25, 'PNG');
$pdf->Ln();


$bloque1 = <<<EOF

<table style="font-size:8px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
			<br><br><br><br><br>
				Corporativo FIVIP SAC
				<br>
				RUC: 20607982873
				<br>
				N° de Serie: $serial
				<br>
				Fecha: $fecha


			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF

<table style="font-size:8px;">
<tr>
	
<td style="width:160px; text-align:left">

</td>

</tr>
<tr>
	
<td style="width:95px; text-align:left">
	CLIENTE: 
</td>
<td style="width:100px; text-align:left">
	DOCUMENTO: 
</td>

</tr>
	<tr>
	
		<td style="width:95px; text-align:left">
        $cliente
		</td>
		<td style="width:100px; text-align:left">
        $tipoD: $nDoc
		</td>

	</tr>
<tr>

<tr>
	
<td style="width:160px; text-align:left">

</td>

</tr>

<td style="width:100px; text-align:left">
	SALIDA: 
</td>
<td style="width:100px; text-align:left">
	DESTINO: 
</td>

</tr>

	<tr>
		<td style="width:95px; text-align:left">
		$estadoS
		</td>
		<td style="width:100px; text-align:left">
       	$estadoD
		</td>
	</tr>

	<tr>
		<td style="width:100px; text-align:left">
		$paisS
		</td>
		<td style="width:100px; text-align:left">
		$paisD
		</td>
	</tr>

	<tr>
		<td style="width:160px; text-align:left">
		</td>
	</tr>

	<tr>
	<td style="width:160px; text-align:left">
	FECHA Y HORA DE SALIDA: 
	</td>
	</tr>

	<tr>
    <td style="width:160px; text-align:left">
    $rutaSalida
    </td>
	</tr>


</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');



$bloque2 = <<<EOF

<table style="font-size:8px;">

	<tr>
		<td style="width:160px; text-align:left">
		---------------------------------------
		</td>
	</tr>
	<tr>
		<td style="width:160px; text-align:left">
		 $simbolo $costo ($iso) 
		</td>
	</tr>

	<tr>
	<td style="width:160px; text-align:left">
	</td>
</tr>

	<tr>
    <td style="width:160px; text-align:left">
    SERVICIOS ADICIONAL:
    </td>
	</tr>

	<tr>
    <td style="width:160px; text-align:left">
    $sa
    </td>
	</tr>
</table>

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');
// set style for barcode
$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// QRCODE,L : QR-CODE Low error correction
$pdf->write2DBarcode('informacion', 'QRCODE,L', 46, 68.9, 50, 25, $style, 'N');
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

// $pdf->Output('factura.pdf', 'D');
$pdf->Output('Boleto.pdf');

}

}

$factura = new imprimirFactura();
$factura ->id=$_GET["id"];
$factura -> traerImpresionFactura();

?>