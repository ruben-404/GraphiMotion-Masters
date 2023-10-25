<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
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
                <button class="botonHead">Inici</button>
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
    include '../funciones.php';

    if (!isset($_SESSION['nom'])) {
        echo("No estás validado");
    } else {
    ?>
   <div class="container">
       
        <a href="EditarProfe.php">
            <button class="botonesEditar">Editar professores</button>
        </a>
       
        <a href="EditarCurso.php">
            <button class="botonesEditar">Editar cursos</button>
        </a>

        <a href="tablaAlumnes.php">
            <button class="botonesEditar">Añadir Alumnos</button>
        </a>

        
   </div>
   
    

    <?php
        }
    
    ?>
</body>
</html>