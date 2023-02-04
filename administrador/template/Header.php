<?php

    session_start();

        if( !isset($_SESSION["usuario"]) ){
            //***si esta vacio la sesion me regresa al index, asi bloquea el ingreso a las siguientes paginas */
            header("Location: ../index.php");
        }else if ( $_SESSION["usuario"] == "ok"){
            //****si no esta vacio guardo el valor del nombre del usuario que viene de la sesion */
            $usuarioLogeado = $_SESSION["nombreUsuario"]; 
        }



?>



<!doctype html>
<html lang="en">

<head>
    <title>Libros</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php  
    
        $url = "http://".$_SERVER["HTTP_HOST"]."/CRUD_LIBROS";
    ?>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Administrador Sitio Web <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href=<?php echo $url."/administrador/section/inicio.php"?>>Inicio</a>
            <a class="nav-item nav-link" href=<?php echo $url."/administrador/section/Products.php"?>>Libros</a>
            <a class="nav-item nav-link" href= <?php echo $url."/administrador/section/Cerrar.php" ?> >Cerrar</a>



        </div>
    </nav>



    <div class="container">
        <div class="row">
            

