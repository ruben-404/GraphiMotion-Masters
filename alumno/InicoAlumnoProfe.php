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
            echo("adios");
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
    <title>Iniciar Sesión alumno profesor</title>
</head>
<body>
    <form method="POST" action="InicoAlumnoProfe.php">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>

        <!-- Casilla de verificación para elegir qué función llamar. -->
        <label for="casilla">Eres profre</label>
        <input type="checkbox" id="casilla" name="casilla"><br><br>

        <input type="submit" value="Iniciar Sesión">
    </form>
    <?php
    }
    ?>
</body>
</html>