<?php
include_once 'conexionpdo.php';
$sql_leer='SELECT * FROM pruebabd';
$gsent=$pdo->prepare($sql_leer);

$gsent->execute();
$resultado=$gsent->fetchall();
//var_dump($resultado);
header('Content-type:application/json');
    echo json_encode($resultado,JSON_PRETTY_PRINT);
?>