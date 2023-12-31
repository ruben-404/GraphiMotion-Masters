<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Añadir Curso</title>
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
        echo("No estás validado");
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigo = $_POST['codigo'];
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
           
            if (VerifyCurso($codigo)) {
                echo("Ese curso ya está registrado");
            } else {
                if (AddCurso($codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final)) {
                    header('location: menu.php');
                } else {
                   
                }
            }
        } else {
    ?>
    <a class="flechaa4" href="menu.php"><img class="flechaa4" src="../imgg/flecha-izquierda.png" alt="Añadir"></a>
    <h1>Añadir Curso</h1>
    <form method="post" action="AñadirCurso.php" enctype="multipart/form-data" onsubmit="return validarFechas();">
        
        <input type="text" id="codigo" name="codigo" placeholder="Código" required><br><br>

        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br><br>

        <!-- <label for="foto">Foto (URL):</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br> -->
        
        
      <!-- <input type="file" id="image" name="image" accept="image/*" style="display: none;" accept="image/*"><br><br> -->
        
        <textarea class="descripcionBox" placeholder="Descripción" id="descripcion" name="descripcion" rows="4" cols="50" required></textarea><br><br>

        <input type="number" id="horas" name="horas" placeholder="Número de Horas" required><br><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input class="fechasInput" type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

        <label for="fecha_final">Fecha final:</label>
        <input class="fechasInput2" type="date" id="fecha_final" name="fecha_final" required><br><br>

        <label for="profe">Profesor:</label>
        <select id="profe" name="profe" required>
            <!-- Opción por defecto -->
            <option value="" disabled selected>Selecciona un profesor</option>

            <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaProfesores = obtenerListaProfesores();

            // Genera las opciones del select en función de la lista de profesores
            foreach ($listaProfesores as $profesor) {
                echo "<option value='" . $profesor['Dni'] . "'>" . $profesor['Dni'] . "-" .$profesor["Nom"]. "</option>";
            }
            ?>

        </select><br><br>
        <div class="edad-foto3">
            <div class="contendorCheck2">
                <label for="estado">Estado:</label>
                <input class="checkboxStyle" type="checkbox" id="estado" name="estado">
            </div>
            

            <label for="image" class="file-label"></label>
            <input type="file" id="image" name="image" accept="image/*" style="display: none;" accept="image/*">
        </div>
        <div class="botonDown">
            <input type="submit" value="Agregar Curso">
        </div>
        
    </form>
    <a href="sortir.php">Salir de la sesión</a>

    <?php
    
    }
    }
    ?>
    
</body>
</html>