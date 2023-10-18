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
    <div class="Contenedor_Principal">
        <nav class="nav">
            <div class = "nav_title"><img class="logo" src="../imgg/logo.png" alt="Logo"></div>
            <a class="title">GraphiMotion Masters</a>
            <ul class="nav_list">
                <li class="nav_item">
                    <button onclick="location.href='../index.php'" class="botonHead">Inici</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='../index.php#nosaltres'" class="botonHead">Nosaltres</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='../index.php#seveis'" class="botonHead">Serveis</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='../index.php#Contacte'" class="botonHead">Contacte</button>
                </li>
                
            </ul>
            <div class="Inicio_sesion">
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
            </div>
        </nav>
        <div class="imagen">
        </div>
        <?php
            
            mostrarNotasCursos($_SESSION['dni']);
            

        ?>
        </div>
        <footer>
    <div class="containFooter">
        <img src="imgg/logo.png" alt="logo" width="211px" height="205px">
        <img src="imgg/instagram.png" alt="instagram" class="social">
        <img src="imgg/facebook.png" alt="facebook" class="social">
        <img src="imgg/tiktok.png" alt="tiktok" class="social" id="tiktok">
        <img src="imgg/youtube.png" alt="youtube" class="social">
        <img src="imgg/twitter.png" alt="twitter" class="social">
    </div>
</footer>
</body>
</html>
