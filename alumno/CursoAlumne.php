<?php
session_start();
include '../funciones.php';
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js"></script>
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
    <div class="Contenedor_Principal">
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
                                echo '<img class="profile" src="../admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto" onclick="mostrarEnlaces()"><br>';
                            
                                echo '<div class="enlaces" id="enlaces-usuario">';
                                echo '<a href="../sortir.php">Sortir</a>';
                                echo '</div>';
                            } else {
                                $fotoURL = GetInfoAlumno($dni, 'foto');
                                echo '<img class="profile" src="../alumno/fotos/' . $fotoURL . '" alt="Vista previa de la foto" onclick="mostrarEnlaces()"><br>';
                            
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
                if ($_SESSION['ROL'] == "profe"){
                    
                    $codigoCurso = $_GET['codigo_curso'];
                    $notas = $_POST['notas'];
                    print_r($notas);
            
                    // Conecta a la base de datos
                    $conexion = conectarseBase();
            
                    // Prepara la consulta para actualizar las notas
                    $sql = "UPDATE curso_alumne SET nota = ? WHERE curso = ? AND alumne = (SELECT DNI FROM alumnes WHERE Nom = ?)";
            
                    // Prepara la declaración SQL
                    $stmt = $conexion->prepare($sql);
            
                    // Recorre el array de notas y realiza las actualizaciones
                    foreach ($notas as $nombre_alumno => $nota) {
                        // Bind de los parámetros y ejecución de la consulta
                        $stmt->bind_param("iss", $nota, $codigoCurso, $nombre_alumno);
                        $stmt->execute();
                    }
            
                    // Cierra la conexión y muestra un mensaje de éxito
                    $stmt->close();
                    $conexion->close();
                    
                    echo "Notas actualizadas con éxito.";
                
                    
                        
                }else{
                    if(isset($_POST['botonB'])){
                        BorrarAlumneCurso($_SESSION['dni'],$_POST['codigo_curso']);
                    }
                    if(isset($_POST['botonM'])){
                        MatricularCurso($_POST['codigo_curso'],$_SESSION['dni']);
                    }
                }
            }
                
            

            // Verificar si se pasó un código de curso en la URL
            if (isset($_GET['codigo_curso'])) {
            // Obtener el código del curso desde la URL
            $codigoCurso = $_GET['codigo_curso'];

            if (isset($_SESSION['dni'])) {
                if ($_SESSION['ROL'] == "profe") {
                    InfoCursoProfe($codigoCurso);
                }else{
                    InfoCurso($codigoCurso);
                }

            }else{
                InfoCurso($codigoCurso);
            }
            
            
            }
            ?>
            
        </div>
    </div>

    <?php
        
        

    ?>
    
<footer>
    <p>hola</p>
</footer>
</body>
</html>


