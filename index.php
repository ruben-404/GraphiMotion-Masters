<?php
session_start();
include 'funciones.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script src="js/script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="Contenedor_Principal">
        <nav class="nav">
            <div class = "nav_title"><img class="logo" src="imgg/logo.png" alt="Logo"></div>
            <a class="title">GraphiMotion Masters</a>
            <ul class="nav_list">
                <li class="nav_item">
                    <button onclick="location.href='index.php'" class="botonHead">Inici</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='#nosaltres'" class="botonHead">Nosaltres</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='#seveis'" class="botonHead">Serveis</button>
                </li>
                <li class="nav_item">
                    <button onclick="location.href='#Contacte'" class="botonHead">Contacte</button>
                </li>
            </ul>
            <div class="inicio_sesion">
                    <?php
                        
                        
                        // Verificar si el usuario ha iniciado sesión y si la variable dni está configurada en la sesión. //meter cursos disponibles y del usuario hacer mas usuario friendly
                        if (isset($_SESSION['dni'])) {
                            $dni = $_SESSION['dni'];
                            
                            if ($_SESSION['ROL'] == "profe") {
                                $fotoURL = GetInfoProfe($dni, 'Foto');
                                echo '<img class="profile" src="admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto" onclick="mostrarEnlaces()"><br>';
                            
                                echo '<div class="enlaces" id="enlaces-usuario">';
                                echo '<a href="sortir.php">Sortir</a></br>';
                                echo '<a href="profe/EditarProfe.php">Info</a><br>';
                                echo '</div>';
                            } else {
                                $fotoURL = GetInfoAlumno($dni, 'Foto');
                                echo '<img class="profile" src="alumno/fotos/' . $fotoURL . '" alt="Vista previa de la foto" onclick="mostrarEnlaces()"><br>';
                            
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
            </div>
                

        </nav>
        <div class="espacioHeader"></div>
        <div class="imagen">
        </div>
        <div class="contenedor">
        <?php
            if (isset($_SESSION['dni'])) {
                echo("<h2>Mis cursos</h2>");
                if ($_SESSION['ROL'] == "profe") {
                    imprimirCursosProfes($_SESSION['ROL'],$_SESSION['dni']);

                }else{
                    imprimirCursos($_SESSION['ROL'],$_SESSION['dni']);
                    echo("<h2>Cursos disponibles</h2>");
                    imprimirCursosNoMatriculados($_SESSION['ROL'],$_SESSION['dni']);
                }
                
            }else{
                imprimirCursosSin();
            }
        ?>
        </div>
        <div class="nosaltres" id="nosaltres">
            <div class="nosaltresImg">
                <img src="imgg/nosaltres.png" alt="foto usu">
            </div>
            <div class="nosaltresText">
                <div class="nosaltresTitle">
                    Sobre Nosaltres
                </div>
                <div class="nosaltresCaja">
                    <a >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</a>
                </div>
            </div>
        </div>
        <div class="serveis" id="seveis">
            <div>
                <div class="nosaltresTitle">
                    Serveis
                </div>
                <div class="nosaltresCaja">
                    <a >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</a>
                </div>
            </div>
            <div class="serveisImg">
                <img src="imgg/serveis.png" alt="foto usu">
            </div>
        </div>
        <div class="contacte" id="Contacte">
            <div class="contactePersona">
                <img src="imgg/coment.png" alt="perfil">
                <div class="cajaContacte">
                    <div>Me ha encantado el curso!! Los profesores se explican super bien! 10/10</div>
                </div>          
            </div>
            <div class="contactePersona">
                <img src="imgg/coment.png" alt="perfil">
                <div class="cajaContacte">
                    <div>Lo que te enseñan en los cursos es muy entretenido, muy recomendable si te gusta este mundillo!</div>
                </div>          
            </div>

        </div>

    </div>
<footer>
    <div class="containFooter">
        <img src="imgg/logo.png" alt="logo" class="logoFooter">
        <img src="imgg/instagram.png" alt="instagram" class="social">
        <img src="imgg/facebook.png" alt="facebook" class="social">
        <img src="imgg/tiktok.png" alt="tiktok" class="social" id="tiktok">
        <img src="imgg/youtube.png" alt="youtube" class="social">
        <img src="imgg/twitter.png" alt="twitter" class="social">
    </div>
</footer>
</body>
</html>



