<?php
session_start();

// Recuperar el nombre y el DNI del profesor de la URL
if (isset($_GET['nombre']) && isset($_GET['dni'])) {
    $_SESSION['profesor_nombre'] = $_GET['nombre'];
    $_SESSION['profesor_dni'] = $_GET['dni'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Profesor</title>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/main.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="index">
    <?php
    include '../funciones.php';
   
    // Verificar si el nombre y el DNI del profesor están en la sesión
    if (!isset($_SESSION['nom'])) {
        // El usuario no está validado, puedes mostrar un mensaje de error o redirigirlo a la página de inicio de sesión.
    } else {
        if (isset($_SESSION['profesor_nombre']) && isset($_SESSION['profesor_dni'])) {
            $nombreProfesor = $_SESSION['profesor_nombre'];
            $dniProfesor = $_SESSION['profesor_dni'];
            echo("<h1>Editar el profesor: ".$nombreProfesor."</h1>");
           
            if ($_POST) {
                $nom = $_POST['nom'];
                $cognom = $_POST['cognom'];
                $titol = $_POST['titol'];
                $foto = adapImage($dniProfesor, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
                $estado = $_POST['estado'];
                if($estado==NULL){
                   $estado=0; 
                }else{
                    $estado=1;
                }

                // Verificar si se proporcionó una nueva contraseña
                $nuevaContrasena = $_POST['contrasenya'];
                if (!empty($nuevaContrasena)) {
                    // Llamar a la función para actualizar la contraseña
                    UpdateContrasenaProfe($dniProfesor, $nuevaContrasena);
                }
                if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
                    $image = adapImage($_POST['dni'], $_FILES['image']['name'], $_FILES['image']['tmp_name']);
                    UpdateFotoProfe($dniProfesor, $foto);
    
                }

                // Llamar a la función para actualizar los demás datos del profesor
                if (UpdateProfe($nom, $dniProfesor, $cognom, $titol, $estado)) {
                    header("Location: menu.php");
                }
            }
        } else {
            echo "Nombre y DNI del profesor no encontrados en la sesión.";
        }
    }
    ?>
    <div class="indexContainer2 boldLetter">
        <div class=child>
            <!-- Formulario de actualización -->
            <form method="POST" action="EditarProfeFormulario.php" enctype="multipart/form-data">
            <div class="centrarIMG">   
            <?php
                    // Mostrar la imagen de vista previa si hay una URL de imagen
                    $fotoURL = GetInfoProfe($dniProfesor, 'foto');
                    // echo($fotoURL);
                    if (!empty($fotoURL)) {
                        echo '<img class="profile"  src="fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="150"><br>';
                }
                    
            ?>
            <div class="centrarIMG">
                <label for="nom">Nombre:</label>
                <input type="text" id="nom" name="nom" value="<?php echo GetInfoProfe($dniProfesor, 'Nom'); ?>" required><br><br>

                <label for="cognom">Apellido:</label>
                <input type="text" id="cognom" name="cognom" value="<?php echo GetInfoProfe($dniProfesor, 'Cognom'); ?>" required><br><br>

                <label for="titol">Título:</label>
                <input type="text" id="titol" name="titol" value="<?php echo GetInfoProfe($dniProfesor, 'titol'); ?>" required><br><br>

                <!-- Campo para la nueva contraseña -->
                <label for="contrasenya">Nueva Contraseña:</label>
                <input type="password" id="contrasenya" name="contrasenya" style="display:none;"><br><br>
            
                <!-- Botón para mostrar/ocultar el campo de contraseña -->
                <button type="button" id="cambiarContrasenaBtn" onclick="toggleContrasena()">Cambiar Contraseña</button>

                <div class="edad-foto2">
                    
                    <label for="estado">Estado:</label>
                    <input class="calendario2" type="checkbox" id="estado" name="estado" <?php echo (GetInfoProfe($dniProfesor, 'estado') == 1) ? 'checked' : ''; ?>>
                    <!-- Utiliza una etiqueta label para el campo de tipo file -->
                    <label for="image" class="file-label"></label>
                    <input type="file" id="image" name="image" accept="image/*" style="display: none;" accept="image/*"><br><br>
                </div>
                <div class="confirmar2">
                    <input type="submit" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</body>
</html>








