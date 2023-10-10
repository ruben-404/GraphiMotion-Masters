<?php
session_start();
include '../funciones.php';
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
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
                <button onclick="location.href='../pages/nosaltres.php'" class="botonHead">Nosaltres</button>
            </li>
            <li class="nav_item">
                <button onclick="location.href='../pages/serveis.php'" class="botonHead">Serveis</button>
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
                            echo '<a href="../alumno/sortir.php">Sortir</a>';
                            echo '</div>';
                        } else {
                            $fotoURL = GetInfoAlumno($dni, 'foto');
                            echo '<img src="../alumno/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="60" id="imagen-usuario" onclick="mostrarEnlaces()"><br>';
                           
                            echo '<div class="enlaces" id="enlaces-usuario">';
                            echo '<a href="../sortir.php">Sortir</a><br>';
                            echo '<a href="EditarAlumno.php">Info</a><br>';
                            echo '<a href="TablaNotas.php">Notas</a><br>';
                            echo '</div>';
                        }
                    } else {
                        // Cuando el usuario no ha iniciado sesión, mostramos la imagen del usuario y ocultamos los enlaces
                        echo '<img src="../img/usu.png" alt="foto usu" id="imagen-usuario" onclick="mostrarEnlaces()">';
                        echo '<div class="enlaces" id="enlaces-usuario">';
                        echo '<a href="AñadirAlumno.php">Registrar</a><br>';
                        echo '<a href="InicoAlumnoProfe.php">Iniciar</a><br>';
                        echo '</div>';
                    }
                    ?>
            </li>
            
        </ul>
    </nav>
    <div class="espacioHeader"></div>
    <div>
        <?php
        // Iniciar la sesión si aún no está iniciada
        if (!isset($_SESSION)) {
        session_start();
        }
        if ($_POST) {
            $codigoCurso=$_POST['codigo_curso'];
            if(isset($_POST['botonB'])){
                BorrarAlumneCurso($_SESSION['dni'],$codigoCurso);
            }
            if(isset($_POST['botonM'])){
                MatricularCurso($codigoCurso,$_SESSION['dni']);
            }
        }

        // Verificar si se pasó un código de curso en la URL
        if (isset($_GET['codigo_curso'])) {
        // Obtener el código del curso desde la URL
        $codigoCurso = $_GET['codigo_curso'];

        InfoCurso($codigoCurso);
        }
        ?>
        
    </div>
    <?php
        
        

    ?>
    <script>
        function mostrarEnlaces() {
            var enlacesUsuario = document.getElementById('enlaces-usuario');
            if (enlacesUsuario.style.display === 'none') {
                enlacesUsuario.style.display = 'block';
            } else {
                enlacesUsuario.style.display = 'none';
            }
        }
        // Captura el clic del botón con el ID 'matricularBtn' y obtén el valor del atributo de datos 'data-curso-id'
        $('#matricularBtn').on('click', function() {
            // Obtiene el valor del atributo de datos 'data-curso-id' del botón
            var cursoId = $(this).data('curso-id');
            // Llama a la función matricularCurso con el ID del curso como argumento
            MatricularCursojs(cursoId);
        });

        function MatricularCursojs(cursoId) {
            console.log(cursoId)
            $.ajax({
                url: '../funciones.php',
                method: 'POST',
                data: { action: 'MatricularCurso', cursoId: cursoId },
            });
        }




        //dar de baja
         // Captura el clic del botón con el ID 'matricularBtn' y obtén el valor del atributo de datos 'data-curso-id'
         $('#DarBajaBtn').on('click', function() {
            // Obtiene el valor del atributo de datos 'data-curso-id' del botón
            var cursoId = $(this).data('curso-id');
            var Dni = $(this).data('dni-id');
            console.log(cursoId);
            console.log(Dni);
            // Llama a la función matricularCurso con el ID del curso como argumento
            BorrarAlumnesjs(Dni,cursoId);
        });

        function BorrarAlumnesjs(Dni,cursoId) {
            $.ajax({
                url: '../funciones.php',
                method: 'POST',
                data: { action: 'BorrarAlumnes',dni: Dni  ,code: cursoId },
            });
        }
        
    </script>
    
<footer class="IndeFooter">
    <p>hola</p>
</footer>
</body>
</html>


