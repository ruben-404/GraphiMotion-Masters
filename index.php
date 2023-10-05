<?php
session_start();
include 'funciones.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="nav">
        <div class = "nav_title"><img src="imgg/logo.png" alt="Logo"></div>
        <h1>GraphiMotion Masters</h1>
        <ul class="nav_list">
            <li class="nav_item">
                <button onclick="location.href='index.php'" class="botonHead">Inici</button>
            </li>
            <li class="nav_item">
                <button onclick="location.href='pages/nosaltres.php'" class="botonHead">Nosaltres</button>
            </li>
            <li class="nav_item">
                <button onclick="location.href='pages/serveis.php'" class="botonHead">Serveis</button>
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
                            echo '<img src="admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="60" id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="sortir.php">Sortir</a>';
                            echo '</div>';
                        } else {
                            $fotoURL = GetInfoAlumno($dni, 'foto');
                            echo '<img src="alumno/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="60" id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="sortir.php">Sortir</a><br>';
                            echo '<a href="alumno/EditarAlumno.php">Info</a><br>';
                            echo '<a href="alumno/TablaNotas.php">Notas</a><br>';
                            echo '</div>';
                        }
                    } else {
                        // Cuando el usuario no ha iniciado sesión, mostramos la imagen del usuario y ocultamos los enlaces
                        echo '<img src="img/usu.png" alt="foto usu" id="imagen-usuario" onclick="mostrarEnlaces()">';
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
    <div class="contenedor">
    <?php
        if (isset($_SESSION['dni'])) {
            imprimirCursos($_SESSION['ROL']);
        }else{
            imprimirCursosSin();
        }

        

    ?>
    </div>
    <div class="nosaltres">
        <div class="nosoltresImg"><img src="imgg/nosaltres.png" alt="foto usu"><div><h2>Sobre nosaltres</h2><p class="NosolatresT">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div></div>
        <div class="nosoltresText">
            


        </div>
    </div>
    <div class="serveis">
        <p>Serveis</p>
    </div>
    <div class="contacte">
        <p>Conctate</p>
    </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Obtén el botón por su ID
        var matricularCursoButton = document.getElementById('matricularCursoButton');

        // Agrega un evento click al botón
        matricularCursoButton.addEventListener('click', function() {
            // Obtén el código del curso que deseas matricular
            var code = '<?php echo $code; ?>';

            
        });
        });
</script>
<footer id="IndeFooter">
    <p>hola</p>
</footer>
</body>
</html>



