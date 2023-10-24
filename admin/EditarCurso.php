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
        <h1>Lista de cursos</h1>
        <a class="buttonAgregar" href="AñadirCurso.php"><img src="../imgg/agregar.png" alt="Añadir"></a>
        
        <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaCursos = obtenerListaCursosa1();
            if($listaCursos!=null){
                // Genera las opciones del select en función de la lista de profesores
                foreach ($listaCursos as $curso) {
                    echo "<div class='listaEdit'><option value='" . $curso['Codigo'] . "'>" . $curso['Codigo'] . '-' . $curso['Nom'] . "</option><a class='editIMG'  href='EditarCursoFormulario.php?id=" . $curso['Codigo'] . "&NomCurso=" . $curso['Nom'] . "&CursoCodigo=" . $curso['Codigo'] . "'><img src='../imgg/edita.png' alt='edita'></a></div>";
                 //   echo "<a href='EditarCursoFormulario.php?id=" . $curso['Codigo'] . "&NomCurso=" . $curso['Nom'] . "&CursoCodigo=" . $curso['Codigo'] . "'>Actualizar</a>";
                }

            }else{
                echo("No hi ha cursos disponibles");
            }

            
        ?>
        <a href="sortir.php">Salir de la session</a>
        
        <?php
            }
        ?>
    </div>
</body>
</html>