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

require_once "extensions/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();