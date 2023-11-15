<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar alumno</title>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body  class="index">
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
            $edad = $_POST['edad'];
            $foto = adapImage($dni, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
            
            // Verificar si se proporcionó una nueva contraseña
            $nuevaContrasena = $_POST['contrasenya'];
            if (!empty($nuevaContrasena)) {
                // Llamar a la función para actualizar la contraseña
                UpdateContrasenaAlumne($dni, $nuevaContrasena);
            }
            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
                $image = adapImage($dni, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
            
                UpdateFotoAlumne($dni, $foto);

            }
            // Llamar a la función para actualizar los demás datos del profesor
            if (UpdateAlumne($nom, $dni, $cognom, $edad)) {
                header("Location: ../index.php");
            }
        }
    }
    
    ?>
    <div class="indexContainer2 boldLetter">
        <div class=child>
            <!-- Formulario de actualización -->
            <form method="POST" action="EditarAlumno.php" enctype="multipart/form-data">
                <div class="centrarIMG">
                <?php
                    // Mostrar la imagen de vista previa si hay una URL de imagen
                    $fotoURL = GetInfoAlumno($dni, 'foto');
                    // echo($fotoURL);
               
                    if (!empty($fotoURL)) {
                        echo '<img  class="profile" src="fotos/' . $fotoURL . '" alt="Vista previa de la foto" ><br>';
                    }                

                    
                ?>    
                </div>                
                <label for="nom">Nombre:</label>
                <input type="text" id="nom" name="nom" value="<?php echo GetInfoAlumno($dni, 'Nom'); ?>" required><br><br>

                <label for="cognom">Apellido:</label>
                <input type="text" id="cognom" name="cognom" value="<?php echo GetInfoAlumno($dni, 'Cognom'); ?>" required><br><br>

                
               
                <div class="edad-foto2">
                    <label class="textEdad" for="edad">Edad:</label>
                    <input class="calendario" type="date" id="edad" name="edad" value="<?php echo GetInfoAlumno($dni, 'Edad'); ?>" required>
                    <label for="image" class="file-label"></label>
                    <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                </div>
                


                <!-- Campo para la nueva contraseña -->
                <div class="contra-desplegable">
                    <label for="contrasenya">Nueva Contraseña:</label>
                    <input type="password" id="contrasenya" name="contrasenya" style="display:none;">
                
                    <!-- Botón para mostrar/ocultar el campo de contraseña -->
                    <button type="button" id="cambiarContrasenaBtn" onclick="toggleContrasena()">Cambiar Contraseña</button>
                </div>
                
                <div class="confirmar2">
                    <input type="submit" value="Guardar">
                </div>
                   
            </form>
        </div>
    </div>
</body>
</html>

