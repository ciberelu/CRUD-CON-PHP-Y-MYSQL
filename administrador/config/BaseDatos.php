<?php


//********* CODIGO PARA CONECTAR A LA BASE DE DATOS MYAPP ******************/
$host = "localhost";
$db = "MYAPP";
$usuario = "root";
$password = "Elu1215*";

try {
    $conection = new PDO(
        "mysql:host=$host;dbname=$db",
        $usuario,
        $password
    );

    // if($conection){
    //     echo "conectado a sistema";
    // }
} catch ( Exception $e) {

    echo "este es el error ".$e->getMessage();
}



?>
