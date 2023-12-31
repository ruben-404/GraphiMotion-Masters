<?php
session_start();


if (isset($_GET['nombre']) && isset($_GET['dni'])) {
    
    $_SESSION['cursoNombre'] = $_GET['nombre'];
    $_SESSION['cursoCodigo'] = $_GET['dni'];
    
    
    
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
<body class = "CrearCursos">
    <?php
    include '../funciones.php';

    if (!isset($_SESSION['nom'])) {
    
    } else {
        if (isset($_SESSION['cursoNombre']) && isset($_SESSION['cursoCodigo'])) {
            $cursoNom = $_SESSION['cursoNombre'];
            $codigo = $_SESSION['cursoCodigo'];
            echo('<a class="flechaa2" href="EditarCurso.php"><img class="flechaa2" src="../imgg/flecha-izquierda.png" alt="Añadir"></a>');
            echo("<h1>Editar el curso: ".$cursoNom."</h1>");
            if ($_POST) {
                $nom = $_POST['nombre'];
                $foto = adapImage($codigo,$_FILES['image']['name'],$_FILES['image']['tmp_name']);
                $descripcion = $_POST['descripcion'];
                $horas = $_POST['horas'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $profe = $_POST['profe'];
                $estado = $_POST['estado'];
                $fecha_final = $_POST['fecha_final'];
                if($estado==NULL){
                    $estado=0; 
                 }else{
                     $estado=1;
                 }
                if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
                    $image = adapImage($codigo, $_FILES['image']['name'], $_FILES['image']['tmp_name']);
                    UpdateFotoCurso($codigo, $foto);
    
                }
                if(UpdateCurso($codigo,$nom, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final)){
                    header("Location: menu.php");
                }
            }
            

        } else {
            echo "curso y codigo del profesor no encontrados en la sesión.";
        }

    
    ?>
    <?php
       
       // Mostrar la imagen de vista previa si hay una URL de imagen
       $profesorSeleccionado =  GetInfoCurso($codigo, 'Profe');
       $fotoURL = GetInfoCurso($codigo, 'foto');
       // echo($fotoURL);
       if (!empty($fotoURL)) {
           echo '<img src="fotos/' . $fotoURL . '" alt="Vista previa de la foto" width="150" class="imgCurso"><br>';
   }
       
       
    echo'<form method="post" enctype="multipart/form-data" action="EditarCursoFormulario.php">';

    
        echo '<input type="text" placeholder="Nombre" id="nombre" name="nombre" value="' . GetInfoCurso($codigo, 'Nom') . '" required><br><br>';

        // echo'<label for="foto">Foto (URL):</label>';
        // echo'<input type="file" id="image" name="image" accept="image/*" value="' . GetInfoCurso($codigo, 'foto') . '"><br><br>';

        echo '<textarea id="descripcion" class="descripcionBox" placeholder="Descripción" name="descripcion" rows="4" cols="50" required>' . GetInfoCurso($codigo, 'Descripcion') . '</textarea><br><br>';

        echo'<input type="number" id="horas"  placeholder="Número de Horas" name="horas" value="' . GetInfoCurso($codigo, 'NumeroHoras') . '" required><br><br>';

        echo'<label for="fecha_inicio">Fecha de Inicio:</label>';
        echo'<input class="fechasInput" type="date" id="fecha_inicio" name="fecha_inicio" value="' . GetInfoCurso($codigo, 'DataInici') . '" required><br><br>';

        echo'<label for="fecha_final">Fecha final:</label>';
        echo'<input class="fechasInput2" type="date" id="fecha_final" name="fecha_final" value="' . GetInfoCurso($codigo, 'DataFinal') . '" required><br><br>';

        echo'<label for="profe">Profesor:</label>';
        echo'<select id="profe" name="profe" required>';
        ?>
              <!-- Opción por defecto -->
            <option value="" disabled>Selecciona un profesor</option>

            <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaProfesores = obtenerListaProfesores();

            // Genera las opciones del select en función de la lista de profesores
            foreach ($listaProfesores as $profesor) {
                $selected = ($profesor['Dni'] == $profesorSeleccionado) ? 'selected' : '';
                echo "<option value='" . $profesor['Dni'] . "' $selected>" . $profesor['Dni'] . "-" . $profesor["Nom"] . "</option>";
            }
        ?>

        </select><br><br>
        <div class="edad-foto3">
            <div class="contendorCheck2">
                <label for="estado">Estado:</label>
                <input type="checkbox"  class="checkboxStyle" id="estado" name="estado" <?php echo (GetInfoCurso($codigo, 'estado') == 1) ? 'checked' : ''; ?>>
            </div>
            <?php
                echo'<label for="image" class="file-label"></label>';
                echo'<input type="file" id="image" name="image" accept="image/*" style="display: none;" value="' . GetInfoCurso($codigo, 'foto') . '"><br><br>';


            ?>
        </div>
        <div class="botonDown">
            <input type="submit" value="Guardar Curso">
        </div>
        <br><br><br><br>
    </form>
   
    <?php
        }
    
    ?>
</body>
</html>
