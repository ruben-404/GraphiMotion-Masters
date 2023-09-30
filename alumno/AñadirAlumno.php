<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear alumno</title>
</head>
<body>
    <?php
    include '../funciones.php';
    if ($_POST) {
        $nom = $_POST['nom'];
        $dni = $_POST['dni'];
        $passwd = $_POST['contrasenya'];
        $cognom = $_POST['cognom'];
        $edad = $_POST['edad'];
        $foto = adapImage($dni,$_FILES['image']['name'],$_FILES['image']['tmp_name']);
        $estado = $_POST['estado'];
        if (VerifyAlumno($dni)){
            echo("Ese alumno ya esta registrado");
            

        }else{
            if (AddAlumno($nom, $dni, $passwd, $cognom, $edad, $foto, $estado)) {
                echo('<a href="index.php">volver al menu</a>');
            } 
        }
        
    } else {
    ?>
   
    <h1>Creacio Alumno</h1>
    <form method="POST" action="AñadirAlumno.php" enctype="multipart/form-data">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>

        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" required><br><br>

        <label for="Edad">Edad:</label>
        <input type="date" id="edad" name="edad" required><br><br>

        <label for="image">Foto (URL):</label>
        <input type="file" id="image" name="image"><br><br>

        <label for="contrasenya">Contraseña:</label>
        <input type="password" id="contrasenya" name="contrasenya" required><br><br>

        <label for="estado">Estado (1 para activo, 0 para inactivo):</label>
        <input type="number" id="estado" name="estado" min="0" max="1" required><br><br>

        <input type="submit" value="Añadir">
    </form>
	<a href="sortir.php">Salir de la session</a>

    <?php
        }
    ?>
</body>
</html>