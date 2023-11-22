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
   
    <h1>Creacio Profesor</h1>
    <form method="POST" action="AñadirProfe.php" enctype="multipart/form-data">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required maxlenght="9" pattern="[0-9]{8}[A-Za-z]{1}" required><br><br>

        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" required><br><br>

        <label for="titol">Título:</label>
        <input type="text" id="titol" name="titol" required><br><br>

        <label for="image">Foto (URL):</label>
        <input type="file" id="foto" name="image" accept="image/*"><br><br>

        <label for="contrasenya">Contraseña:</label>
        <input type="password" id="contrasenya" name="contrasenya" required><br><br>

        <label for="estado">Estado:</label>
        <input class="checkboxStyle" type="checkbox" id="estado" name="estado">

        <div>
        <input type="submit" value="Añadir Profesor">
        <div>
    </form>
	<a href="sortir.php">Salir de la session</a>

    <?php
        }
    }
    ?>
</body>
</html>
