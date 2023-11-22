<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <script src="../js/script.js"></script>
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
        
        <form method="POST" action="EditarProfe.php" enctype="multipart/form-data" class="buscador">
            <input type="text" id="searchInput" name="searchInput" placeholder="Buscar por nombre del curso">
            <div class="div_lupa"><input type="submit" class="lupa"></div>
        </form>
        <?php
            // Llama a la función obtenerListaProfesores para obtener la lista de profesores
            $listaProfesores = obtenerListaProfesores();

            // Genera las opciones del select en función de la lista de profesores
            if($listaProfesores!=null){
                echo"<div>";
                foreach ($listaProfesores as $profesor) {
                    $id =  $profesor['Dni'] ;
                    $nombreCurso = $profesor['Nom'];

                    if($_POST){
                        if($nombreCurso==$_POST['searchInput']){
                            echo "<div class='listaEdit'>";
                            echo "<div>" . $id . " " . $nombreCurso . "</div>";
                            // Usar urlencode para codificar los valores en la URL
                            echo "<a class='editIMG' href='EditarProfeFormulario.php?id=" . urlencode($id) . "&nombre=" . urlencode($nombreCurso) . "&dni=" . urlencode($id) . "'><img src='../imgg/edita.png' alt='edita'></a>";
                            echo "</div>";     
                        }     

                    }else{
                        echo "<div class='listaEdit'>";
                        echo "<div>" . $id . " " . $nombreCurso . "</div>";
                        // Usar urlencode para codificar los valores en la URL
                        echo "<a class='editIMG' href='EditarProfeFormulario.php?id=" . urlencode($id) . "&nombre=" . urlencode($nombreCurso) . "&dni=" . urlencode($id) . "'><img src='../imgg/edita.png' alt='edita'></a>";
                        echo "</div>";                  
                    }
                    
                }
                echo"</div>";

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