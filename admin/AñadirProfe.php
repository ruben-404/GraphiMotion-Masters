<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class = "CrearCursos">
    <?php
    include '../funciones.php';

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
        if ($_POST) {
            $nom = $_POST['nom'];
            $dni = $_POST['dni'];
            $passwd = $_POST['contrasenya'];
            $cognom = $_POST['cognom'];
            $titol = $_POST['titol'];
            $foto = adapImage($dni,$_FILES['image']['name'],$_FILES['image']['tmp_name']);
            $estado = $_POST['estado'];
            if($estado==NULL){
                $estado=0; 
             }else{
                 $estado=1;
             }
            if (VerifyProfe($dni)){
                echo("Ese profe ya esta registrado");
               

            }else{
                if (AddProfe($nom, $dni, $passwd, $cognom, $titol, $foto, $estado)) {
                    echo('<a href="menu.php">volver al menu</a>');
                } 
            }
            
        } else {
    ?>
    <a class="flechaa3" href="menu.php"><img class="flechaa3" src="../imgg/flecha-izquierda.png" alt="Añadir"></a>
    <h1>Creacio Profesor</h1>
    <form method="POST" action="AñadirProfe.php" enctype="multipart/form-data">
      
        <input type="text" id="dni" placeholder="DNI" name="dni" required maxlenght="9" pattern="[0-9]{8}[A-Za-z]{1}" required><br><br>

        <input type="text" id="nom" name="nom" placeholder="Nom" required><br><br>

        <input type="text" id="cognom" name="cognom" placeholder="Cognom" required><br><br>

        <input type="text" id="titol" name="titol" placeholder="Título" required><br><br>

        <!-- <label for="image">Foto (URL):</label>
        <input type="file" id="foto" name="image" accept="image/*"><br><br> -->

        <input type="password" id="contrasenya" name="contrasenya" placeholder="Contraseña" ><br><br>

        <!-- <label for="estado">Estado:</label>
        <input class="checkboxStyle" type="checkbox" id="estado" name="estado"> -->
        <div class="edad-foto3">
            <div class="contendorCheck2">
                <label for="estado">Estado:</label>
                <input class="checkboxStyle" type="checkbox" id="estado" name="estado">
            </div>
            
            <label for="image" class="file-label"></label>
            <input type="file" id="image" name="image" accept="image/*" style="display: none;" accept="image/*">
        </div>
        <div class="botonDown">
        <input type="submit" value="Añadir Profesor">
        <div>
    </form>
    <br><br>   
    <br><br>
	<a href="sortir.php">Salir de la session</a>

    <?php
        }
    }
    ?>
</body>
</html>
