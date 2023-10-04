<?php
session_start();
include '../funciones.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
                <button onclick="location.href='nosaltres.php'" class="botonHead">Nosaltres</button>
            </li>
            <li class="nav_item">
                <button onclick="location.href='serveis.php'"  class="botonHead">Serveis</button>
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
                            echo '<img src="../admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="60" id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="../sortir.php">Sortir</a>';
                            echo '</div>';
                        } else {
                            $fotoURL = GetInfoAlumno($dni, 'foto');
                            echo '<img src="../alumno/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="60" id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="sortir.php">Sortir</a><br>';
                            echo '<a href="../alumno/EditarAlumno.php">Info</a><br>';
                            echo '<a href="../alumno/TablaNotas.php">Notas</a><br>';
                            echo '</div>';
                        }
                    } else {
                        // Cuando el usuario no ha iniciado sesión, mostramos la imagen del usuario y ocultamos los enlaces
                        echo '<img src="../img/usu.png" alt="foto usu" id="imagen-usuario" onclick="mostrarEnlaces()">';
                        echo '<div class="enlaces" id="enlaces-usuario">';
                        echo '<a href="../alumno/AñadirAlumno.php">Registrar</a><br>';
                        echo '<a href="../alumno/InicoAlumnoProfe.php">Iniciar</a><br>';
                        echo '</div>';
                    }
                    ?>
            </li>
            
        </ul>
    </nav>
    <div class="imagen">
        
    </div>
    <p>serveis</p>
    <script>
        function mostrarEnlaces() {
            var enlacesUsuario = document.getElementById('enlaces-usuario');
            if (enlacesUsuario.style.display === 'none') {
                enlacesUsuario.style.display = 'block';
            } else {
                enlacesUsuario.style.display = 'none';
            }
        }
    </script>
<footer class="footerPage">
    <p>hola</p>
</footer>
</body>
</html>



