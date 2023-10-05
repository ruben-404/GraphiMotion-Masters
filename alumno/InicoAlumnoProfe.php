<?php
session_start();

include '../funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
    $contrasena = $_POST['contrasena'];

    // Verifica si la casilla ha sido marcada.
    $casillaMarcada = isset($_POST['casilla']) && $_POST['casilla'] == 'on';

    if ($casillaMarcada) {
        if(VerifyProfeC($dni,$contrasena)){
            $_SESSION['dni']=$dni;
            $_SESSION['ROL']="profe";
            header('location: ../index.php');

        }else{
            echo("Incorrecto");
        }
    } else {
        if(VerifyAlumnoc($dni,$contrasena)){
            $_SESSION['dni']=$dni;
            $_SESSION['ROL']="alumne";
            header('location: ../index.php');
        }else{
            echo("Incorrecto");
        }
    }
}else{
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
<body class="index">
    
        <div class="indexContainer">
            <div class=child>
                <form method="POST" action="InicoAlumnoProfe.php">
                    <input type="text" id="dni" name="dni" placeholder="DNI" required><br><br>
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contrasenya" required><br><br>
                    <!-- Casilla de verificación para elegir qué función llamar. -->
                    <label for="casilla">Eres profre</label>
                    <input type="checkbox" id="casilla" name="casilla"><br><br>
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </div>
        </div>

    
    <?php
    }
    ?>
</body>
</html>