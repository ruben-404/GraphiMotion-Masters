<?php
session_start();
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
<body>
    <div class="containerEdit">
        <?php
        include '../funciones.php';

        if (!isset($_SESSION['nom'])) {
            echo("No estás validado");
        } else {
            
        ?>
    
        <h1>Lista de Professors</h1>
        <a class="buttonAgregar" href="AñadirProfe.php"><img src="../imgg/agregar.png" alt="Añadir"></a>
        
        <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaProfesores = obtenerListaProfesores();

            // Genera las opciones del select en función de la lista de profesores
            if($listaProfesores!=null){
                foreach ($listaProfesores as $profesor) {
                    echo "<div class='listaEdit'><option value='" . $profesor['Dni'] . "'>" . $profesor['Dni'] . "    " . $profesor['Nom'] . "</option><a class='editIMG' href='EditarProfeFormulario.php?id=" . $profesor['Dni'] . "&nombre=" . $profesor['Nom'] . "&dni=" . $profesor['Dni'] . "'><img src='../imgg/edita.png' alt='edita'></a></div>";
                    
                   // echo "<a href='EditarProfeFormulario.php?id=" . $profesor['Dni'] . "&nombre=" . $profesor['Nom'] . "&dni=" . $profesor['Dni'] . "'>Actualizar</a>";
                    
                }

            }else{
                echo("No se han encontrado profes");
            }
            
        ?>
        <a href="sortir.php">Salir de la session</a>
        
        <?php
            }
        ?>
    </div>
<footer></footer>
</body>
</html>