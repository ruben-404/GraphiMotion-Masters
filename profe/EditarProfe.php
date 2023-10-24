<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar alumno</title>
    <script src="../js/script.js"></script>

</head>
<body>
    <?php
    include '../funciones.php';
   
    // Verificar si el nombre y el DNI del profesor están en la sesión
    if (!isset($_SESSION['dni'])) {
        echo("No estas validado");
    } else {
    
        $dni=$_SESSION['dni'];
        
        if ($_POST) {
            $nom = $_POST['nom'];
            $cognom = $_POST['cognom'];
            $titol = $_POST['titol'];
            $foto = adapImageProfes($dni, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
            
            // Verificar si se proporcionó una nueva contraseña
            $nuevaContrasena = $_POST['contrasenya'];
            if (!empty($nuevaContrasena)) {
                // Llamar a la función para actualizar la contraseña
                UpdateContrasenaProfe($dni, $nuevaContrasena);
            }
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
                $image = adapImage($dni, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
                UpdateFotoProfe($dni, $foto);

            }
            // Llamar a la función para actualizar los demás datos del profesor
            if (UpdateProfeyou($nom,$dni,$cognom,$titol)) {
                header("Location: ../index.php");
            }
        }
    }
    
    ?>

    <!-- Formulario de actualización -->
    <form method="POST" action="EditarProfe.php" enctype="multipart/form-data">
        
        <?php
            echo("Editar Profe".$dni);
            // Mostrar la imagen de vista previa si hay una URL de imagen
            $fotoURL = GetInfoProfe($dni, 'foto');
            
            // echo($fotoURL);
            if (!empty($fotoURL)) {
                echo '<img src="../admin/fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="150"><br>';
        }else{
            
        }
            
        ?>
        <label for="nom">Nombre:</label>
        <input type="text" id="nom" name="nom" value="<?php echo GetInfoProfe($dni, 'Nom'); ?>" required><br><br>

        <label for="cognom">Apellido:</label>
        <input type="text" id="cognom" name="cognom" value="<?php echo GetInfoProfe($dni, 'Cognom'); ?>" required><br><br>

        <label for="titol">Título:</label>
        <input type="text" id="titol" name="titol" value="<?php echo GetInfoProfe($dni, 'titol'); ?>" required><br><br>

        <label for="image">Foto:</label>
        <input type="file" id="image" name="image"><br>

        <!-- Campo para la nueva contraseña -->
        <label for="contrasenya">Nueva Contraseña:</label>
        <input type="password" id="contrasenya" name="contrasenya" style="display:none;"><br><br>
       
        <!-- Botón para mostrar/ocultar el campo de contraseña -->
        <button type="button" id="cambiarContrasenaBtn" onclick="toggleContrasena()">Cambiar Contraseña</button>

        <input type="submit" value="Editar">
    </form>

    
</body>
</html>