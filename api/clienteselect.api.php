<?php
require_once '../models/conexion.php';

// Numero de registros
$numero_de_registros = 10;

if(!isset($_POST['palabraClave'])){

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes ORDER BY nombres LIMIT :limit");
$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
$stmt->execute();
$clienteList = $stmt->fetchAll();

}else{

$search = $_POST['palabraClave'];// Palabra a buscar

// Obtener registros
$stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE nombres like :nombres ORDER BY nombres LIMIT :limit");
$stmt->bindValue(':nombres', '%'.$search.'%', PDO::PARAM_STR);
$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
$stmt->execute();
$clienteList = $stmt->fetchAll();

}

$response = array();

// Leer la informacion
foreach($clienteList as $cliente){
$response[] = array(
"id" => $cliente['id'],
"nombres" => $cliente['nombres'],
"apellidos" => $cliente['apellidos'],
"tipo_doc" => $cliente['tipo_doc'],
"numero_doc" => $cliente['documento']
);
}

echo json_encode($response);
exit();