<?php
session_start();
include '../funciones.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <script src="../js/script.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav">
        <div id="logo"></div>
        <h1 class = "nav_title">GraphiMotion Masters</h1>
        <ul class="nav_list">
            <li class="nav_item">
                <button onclick="location.href='menu.php'" class="botonHead">Inici</button>
            </li>
            <li class="nav_item">
                <button class="botonHead">Nosaltres</button>
            </li>
            <li class="nav_item">
                <button class="botonHead">Serveis</button>
            </li>
            <li class="nav_item">
                <button class="botonHead">Contacte</button>
            </li>
            <li class="nav_item">
                <?php
                    echo '<img src="../img/usu.png" alt="foto usu" id="imagen-usuario" onclick="mostrarEnlaces()">';
                    echo '<div class="enlaces" id="enlaces-usuario">';
                    echo '<a href="sortir.php">sortir</a><br>';
                    echo '</div>';
                
                ?>
            </li>
            
        </ul>
    </nav>
    <div class="imagen">
    </div>
    <?php
  

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
    ?>
   <div class="container">
       
        <input type="file" id="archivoInput">
        <table id="tablaEstudiantes"></table>
        <button id="enviarDatos" onclick="enviarDatosEstudiantes()">Enviar Datos a PHP</button>
        <p id="resultado"></p>



        
   </div>
   
    

    <?php
        }
    
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            document.getElementById('archivoInput').addEventListener('change', procesarArchivo);
        });
    </script>


</body>
</html>