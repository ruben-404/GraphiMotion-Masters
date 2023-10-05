<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear alumno</title>
    <script src="../js/concurso.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body  class="index">
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
            echo('<a href="../index.php">volver al menu</a>');

            

        }else{
            if (AddAlumno($nom, $dni, $passwd, $cognom, $edad, $foto, $estado)) {
                echo"<script>PremiosBuenos();<script>";
                echo('<a href="../index.php">volver al menu</a>');
            
            } 
        }
        
    } else {
    ?>
   
   <div class="indexContainer2">
        <div class=child>
            <form method="POST" action="AñadirAlumno.php" enctype="multipart/form-data">
                <input type="text" id="dni" name="dni" placeholder="DNI" required><br><br>
                <input type="text" id="nom" name="nom" placeholder="Nom" required><br><br>
                <input type="text" id="cognom" name="cognom" placeholder="Cognom" required><br><br>
                <input type="password" id="contrasenya" name="contrasenya" placeholder="Contrasenya" required><br><br>
          
                
                <div class="edad-foto">
                    <input type="date" id="edad" name="edad" placeholder="Edad" required><br><br>
                <!-- Utiliza una etiqueta label para el campo de tipo file -->
                    <label for="image" class="file-label"></label>
                    <input type="file" id="image" name="image" style="display: none;"><br><br>
                </div>

                <input type="submit" value="Añadir">
            </form>
            
    
        </div>
    </div>
    <?php
        }
    ?>
</body>
</html>
