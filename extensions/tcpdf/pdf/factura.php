<?php

require_once "../../../controllers/remesas.controller.php";
require_once "../../../models/remesas.model.php";

require_once "../../../controllers/clientes.controller.php";
require_once "../../../models/clientes.model.php";

require_once "../../../controllers/usuarios.controller.php";
require_once "../../../models/usuario.model.php";

require_once "../../../controllers/banco-vene.controller.php";
require_once "../../../models/banco-vene.model.php";

// require_once "../../../controllers/productos.controller.php";
// require_once "../../../models/productos.model.php";

class imprimirFactura{

public $id;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemRemesa = "id";
$valorRemesa = $this->id;

$respuestaRemesa = RemesasController::ctrMostrarRemesas($itemRemesa, $valorRemesa);

$fecha = $respuestaRemesa["fecha"];
$serie = $respuestaRemesa["correlativo"];
$remesa = $respuestaRemesa["pais"]." - Venezuela";
$tasa = number_format($respuestaRemesa["tasa"],4,',','.');
$total = number_format($respuestaRemesa["total_remesa"],2,',','.');
$monto = number_format($respuestaRemesa["total_envio"],2,',','.');
$nombre_banco  = $respuestaRemesa["banco"];
$n_cuenta  = $respuestaRemesa["n_cuenta"];
$tipo_doc = $respuestaRemesa["tipo_documento"];
$n_doc = $respuestaRemesa["n_doc"];
$simbolo = $respuestaRemesa["simbolo_moneda"];
$iso = $respuestaRemesa["iso_moneda"];
$nombre = $respuestaRemesa["receptor"];
$pago_movil = $respuestaRemesa["ban_pa_m"];
$cliente = $respuestaRemesa["CONCAT(nombres,' ',apellidos)"];
$telefono_cliente = $respuestaRemesa["telefono"];
$iso_tasa = $respuestaRemesa["iso_tasa"];
$simbolo_tasa = $respuestaRemesa["simbolo_tasa"];


if($nombre_banco == 'PAGO MOVIL'){
	$banco = $nombre_banco.': '."\n".$n_cuenta.' - '. $pago_movil ;
}else{
	$banco = $nombre_banco.': '.$n_cuenta  ;
}
//TRAEMOS LA INFORMACIÓN DEL CLIENTE

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];

// $respuestaCliente = ClientesController::ctrMostrarClientes($itemCliente, $valorCliente);



//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$medidas = array(80, 107);
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
				N° de Serie: $serie
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
	Remesa: $remesa
</td>

</tr>
	<tr>
	
		<td style="width:160px; text-align:left">
		$banco
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:left">
	$tipo_doc: $n_doc
		</td>

	</tr>
	<tr>
	
		<td style="width:160px; text-align:left">
	Nombre: $nombre
		</td>

	</tr>


	<tr>
	
		<td style="width:160px; text-align:left">
		Monto: $simbolo$monto ($iso)
		</td>

	</tr>
	<tr>
	
		<td style="width:160px; text-align:left">
		Tasa: $simbolo_tasa$tasa ($iso_tasa)
		</td>

	</tr>
	<tr>
	
		<td style="width:160px; text-align:left">
		Total: $simbolo_tasa$total ($iso_tasa)
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
			Cliente: $cliente
		</td>
	</tr>
	<tr>
		<td style="width:160px; text-align:left">
			Teléfono: $telefono_cliente
		</td>
	</tr>
	<tr>
		<td style="width:160px; text-align:left">
			Terminos de la empresa
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
$pdf->write2DBarcode($serie." - Cliente:".$cliente." - Tasa:".$tasa." - Monto:".$monto." - Total:".$total , 'QRCODE,L', 48, 68.9, 50, 17, $style, 'N');
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

// $pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> id = $_GET["id"];
$factura -> traerImpresionFactura();

?>