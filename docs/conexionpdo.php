<?php
/*Datos de conexion a la base de datos
$db_host = "localhost";
$db_user = "ultraexp_ultraexp";
$db_pass = "Impotec2018";
$db_name = "ultraexp_empleados";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
	echo 'No se pudo conectar a la base de datos : '.mysqli_connect_error();
}
*/
$link='mysql:host=localhost;dbname=nuevanueva';
$usuario='root';
$pass='';
try{
    $pdo= new PDO($link,$usuario,$pass);
   // echo 'conectado';
}catch (PDOException $e){
    echo 'no conectado'.$e;
}

?>