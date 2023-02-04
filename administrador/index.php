<?php 

    //********para indicar que se va a tener una sesion de usuario */
    session_start();

    //**** en el post hacen un envio de datos que se reciben por el metodo post*/
    if ($_POST){
        if($_POST["usuario"] == "ciberelu" && $_POST["password"] == "ciberelu"){
            $_SESSION["usuario"] = "ok";
            $_SESSION["nombreUsuario"] = "ciberelu";
            header("Location: ./section/inicio.php");
        }else{
            $mensaje = "Datos incorrectos";
        }
        
    }
?>





<!doctype html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        
        <div class="row">
            <div class="col-md-4">
            
            </div>
            
            <div class="col-md-4">
            <br>
            <br>
            <br>
            <br>
            <br>

                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php  if (isset($mensaje)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje?>
                        </div>
                        <?php
                        }
                        ?>
                        <form method="POST">

                            <div class = "form-group">
                                <label >Usuario</label>
                                <input type="text" class="form-control" name="usuario"  placeholder="Ingrese su usuario">
                                
                            </div>

                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Ingresar</button>

                        </form>
                        
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
      </div>
  </body>
</html>