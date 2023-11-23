<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="index">
    <?php
    include '../funciones.php';
    if ($_POST){
        $nom = $_POST['nombre'];
        $passwd = $_POST['contrasena'];

        $_SESSION['nom']=$nom;

        if(VerifyAdmin($nom,$passwd)){
            header('location: menu.php');
        }else{
            echo("<script>alert('Error al iniciar sesion')</script>");
            echo("<meta http-equiv='refresh' content='0.1'");
        }
    }
    
    else{
    
    ?>
    <div class="indexContainer">
        <div class=child>
            <form method="POST" action="index.php">
                <input type="text" id="nombre" name="nombre" placeholder="nom usuari" required><br><br>
                <input type="password" id="contrasena" name="contrasena" placeholder="Contrasenya" required><br><br>

                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </div>



<?php
    }
?>
</body>
</html>





