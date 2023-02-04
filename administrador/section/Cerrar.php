<?php

session_start();

//elimina la sesion y redirige al index en donde esta el login
session_destroy();

header("Location:../index.php");
echo "hola"

?>