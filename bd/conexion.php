<?php
// Configuración de la conexión
try {
    $conexion=new PDO("mysql:host=localhost;dbname=terapia_ocupacional","root","");
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (Exception $e){
    echo "Error: ".$e->getMessage();
    die();
}
?>