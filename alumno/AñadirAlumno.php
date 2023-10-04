<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear alumno</title>
    <script src="../js/concurso.js"></script>
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
        $estado = 1;
        if (VerifyAlumno($dni)){
            echo("Ese alumno ya esta registrado");
            

        }else{
            if (AddAlumno($nom, $dni, $passwd, $cognom, $edad, $foto, $estado)) {
                echo"<script>PremiosBuenos();<script>";
                echo('<a href="../index.php">volver al menu</a>');
            } 
        }
        
    } else {
    ?>
   
    <h1>Creacio Alumno</h1>
    <form method="POST" action="AñadirAlumno.php" enctype="multipart/form-data">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required maxlenght="9" pattern="[0-9]{8}[A-Za-z]{1}"><br><br>

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


        <input type="submit" value="Añadir">
    </form>
	<a href="sortir.php">Salir de la session</a>

    <?php
        }
    ?>
</body>
</html>
