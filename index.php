<?php
//controladores 
require_once "controllers/plantilla.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/moneda.controller.php";
require_once "controllers/banco-vene.controller.php";
require_once "controllers/pais.controller.php";
require_once "controllers/tasa.controller.php";
require_once "controllers/clientes.controller.php";
require_once "controllers/remesas.controller.php";
require_once "controllers/banco-inter.controller.php";
require_once "controllers/pagos.controller.php";
require_once "controllers/recargas.controller.php";
require_once "controllers/cuenta-banco-vene.controller.php";
require_once "controllers/cuenta-banco-inter.controller.php";
require_once "controllers/saldo-cuenta-vene.controller.php";
require_once "controllers/saldo-cuenta-inter.controller.php";
require_once "controllers/creditos.controller.php";
require_once "controllers/pagosR.controller.php";
require_once "controllers/boletos.controller.php";

//modelos
require_once "models/usuario.model.php";
require_once "models/moneda.model.php";
require_once "models/banco-vene.model.php";
require_once "models/pais.model.php";
require_once "models/tasa.model.php";
require_once "models/clientes.model.php";
require_once "models/remesas.model.php";
require_once "models/banco-inter.model.php";
require_once "models/pagos.model.php";
require_once "models/recargas.model.php";
require_once "models/cuenta-banco-vene.model.php";
require_once "models/cuenta-banco-inter.model.php";
require_once "models/saldo-cuenta-vene.model.php";
require_once "models/saldo-cuenta-inter.model.php";
require_once "models/movimientos-bancarios.model.php";
require_once "models/creditos.model.php";
require_once "models/pagosR.model.php";
require_once "models/servicios-adicionales.model.php";
require_once "models/boletos.model.php";
require_once "models/pagos-boletos.model.php";

require_once "extensions/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();