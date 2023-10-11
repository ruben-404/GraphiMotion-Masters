<?php
session_start();
include '../funciones.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Notas</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="../js/script.js"></script>
    <style>
        /* Estilo para ocultar los enlaces inicialmente */
        .enlaces {
            display: none;
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class = "nav_title"><img src="../imgg/logo.png" alt="Logo"></div>
        <h1>GraphiMotion Masters</h1>
        <ul class="nav_list">
            <li class="nav_item">
                <button onclick="location.href='../index.php'" class="botonHead">Inici</button>
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
                    
                    
                    // Verificar si el usuario ha iniciado sesión y si la variable dni está configurada en la sesión.
                    if (isset($_SESSION['dni'])) {
                        $dni = $_SESSION['dni'];
                        
                        if ($_SESSION['ROL'] == "profe") {
                            $fotoURL = GetInfoProfe($dni, 'foto');
                            echo '<img src="../admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto"  id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="sortir.php">Sortir</a>';
                            echo '</div>';
                        } else {
                            $fotoURL = GetInfoAlumno($dni, 'foto');
                            echo '<img class="profile" src="fotos/' . $fotoURL . '" alt="Vista previa de la foto" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="../sortir.php">Sortir</a><br>';
                            echo '<a href="EditarAlumno.php">Info</a><br>';
                            echo '</div>';
                        }
                    } else {
                        // Cuando el usuario no ha iniciado sesión, mostramos la imagen del usuario y ocultamos los enlaces
                        echo '<img src="../img/usu.png" alt="foto usu" id="imagen-usuario" onclick="mostrarEnlaces()">';
                        echo '<div class="enlaces" id="enlaces-usuario">';
                        echo '<a href="alumno/AñadirAlumno.php">Registrar</a><br>';
                        echo '<a href="alumno/InicoAlumnoProfe.php">Iniciar</a><br>';
                        echo '</div>';
                    }
                    ?>
            </li>
            
        </ul>
    </nav>
    <div class="imagen">
    </div>
    <?php
        
        mostrarNotasCursos($_SESSION['dni']);
        

    ?>
</body>
</html>
