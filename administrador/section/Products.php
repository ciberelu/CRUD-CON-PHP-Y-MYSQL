<?php include("../template/Header.php") ?>

<?php 


// print_r($_POST);
// print_r($_FILES);

//**incluye el archivo php que tiene la conexion a la base de datos para poder utilizarlo en esta parte del codigo */
include("../config/BaseDatos.php");


//***guarda los valores que vienen de los input del formulario */
$txtId = (isset($_POST["txtId"]))? $_POST["txtId"] : "";
$txtNombre = (isset($_POST["txtNombre"]))? $_POST["txtNombre"] : "";
$txtImagen = (isset($_FILES["txtImage"]["name"]))? $_FILES["txtImage"]["name"] : "";
$Accion = (isset($_POST["accion"]))? $_POST["accion"] : "";

// echo $txtId."<br>";
// echo $txtNombre."<br>";
// echo $txtImagen."<br>";
// echo $Accion."<br>";


//******para verificar que accion esta solicitando el usuario hacer con los botones */
if ($Accion == "Agregar"){
    $query = $conection->prepare("INSERT INTO libros (nombre, imagen)VALUES(?,?);");
    $resultado = $query->execute([$txtNombre, $txtImagen]);
}else if ($Accion == "Modificar"){
    // echo "se presiono el boton modificar";

    //**este codigo actualiza la columna del nombre del libro */
    $query = $conection->prepare("UPDATE libros SET nombre=? WHERE id=?;");
    $query->execute([$txtNombre, $txtId]);

    //**modifica la imagen en caso de agregarse una nueva imagen */
    if($txtImagen != ""){
        $query = $conection->prepare("UPDATE libros SET imagen=? WHERE id=?;");
        $query->execute([$txtImagen, $txtId]);
    }

    //**redirige a productos para que se refresque la pagina */
    header("location: ./Products.php");

}else if ($Accion == "Cancelar"){
    // echo "se presiono el boton cancelar";

    //**redirige a productos para que se refresque la pagina */
    header("location: ./Products.php");


}else if ($Accion == "Seleccionar"){
    // echo "se presiono el boton Seleccionar";
    $query = $conection->prepare("SELECT * FROM libros WHERE id=?;");
    $query->execute([$txtId]);

    //**guardo en una variable lo que venga de la consulta */
    $Libro = $query->fetch(PDO::FETCH_LAZY);

    $txtNombre = $Libro["nombre"];
    $txtImagen = $Libro["imagen"];


}else if ($Accion == "Borrar"){
    // echo "se presiono el boton Borrar";
    $query = $conection->prepare("DELETE FROM libros WHERE id=?;");
    $resultado = $query->execute([$txtId]);

    header("location: ./Products.php");

}

//**este codigo se ejecuta cuando la pagina carga y trae todos los libros que hayan en esta tabla de libros */
$query = $conection->prepare("SELECT * FROM libros");
$query->execute();
$Libros = $query->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="col-md-5">
            <br>
            <br>    
            <br>

    <div class="card">
        <div class="card-header bg-dark text-white text-center">
            Datos del Libro
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">  <!-- para que acepte varios tipos de archivo  -->

                <div class="form-group">
                    <label for="exampleInputEmail1">Id:</label>
                    <input type="text" required readonly class="form-control" id="txtId" name="txtId" placeholder="Id" value=<?php echo $txtId ?>>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Libro:</label>
                    <input type="text" required class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre del Libro" value=<?php echo "$txtNombre" ?>>
                </div>

                <div class="form-group">
                    <label>Imagen:</label>
                    <?php echo ($txtImagen) ?  "value=".$txtImagen :  "";?>
                 
                    <input type="file"  class="form-control" id="txtImage" name="txtImage" placeholder="Id">
                </div>

                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" <?php echo ($Accion == "Seleccionar")? "disabled": ""; ?> name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" <?php echo ($Accion != "Seleccionar")? "disabled": ""; ?> name="accion"  value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" <?php echo ($Accion != "Seleccionar")? "disabled": ""; ?> name="accion"   value="Cancelar"class="btn btn-info">Cancelar</button>
                </div>
            </form>
        </div>

    </div>







</div>

<div class="col-md-7">
    <br>
    <br>
    <br>

    <table class="table table-bordered">
        <thead class="bg-dark text-white text-center">
            <tr>
                <th >Id</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>

            <!-- $Libros guarda la informacion que viene de la consulta donde selecciona todos los Libros -->
            <?php foreach ($Libros as $libro){ ?>
                           
            
            <tr>
                <td><?php echo $libro["id"]?></td>
                <td><?php echo $libro["nombre"]?></td>
                <td>
                   <img class="img-thumbnail rounded" src="../../images/<?php echo $libro["imagen"]?>" alt="? imagen" srcset="" width="50px">
                </td>

                <td>

                    <form action="" method="POST">

                        <input type="hidden" name="txtId" value=<?php echo $libro["id"]?>>
                        <input type="submit" value="Seleccionar" name="accion" class="btn btn-primary">
                        <input type="submit" value="Borrar" name="accion" class="btn btn-danger">

                    </form>

                </td>

            </tr>

            <?php } ?>

                
            
            
        </tbody>
    </table>
</div>





<?php include("../template/Footer.php") ?>