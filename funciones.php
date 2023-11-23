<?php
// Funcion conectarseBase () Este metodo permite realizar la consulta de la base de
function conectarseBase()
{
    $conexion = mysqli_connect("localhost", "root", "", "learning-academy");
    if (!$conexion) {
        mysqli_connect_error();
        echo("error");

    }
    return $conexion;
}

// Verifica si el usuario esta contrario devuelve
function VerifyAdmin($name,$passwd1)
{
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM admin WHERE Nom = ? AND contrasenya = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    //$stmt->bind_param("ss", $name, $passwd);
    $stmt->bind_param("ss", $name, $passwd);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}

// \ brief Verifie la conexion desde la base \ param $dni DNI a recuper
function VerifyAlumnoc($dni,$passwd1)
{
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    
    $sql = "SELECT * FROM alumnes WHERE DNI = ? AND Contrasenya = ?";

    $stmt = $conexion->prepare($sql);
   
    $stmt->bind_param("ss", $dni, $passwd);
   
    $stmt->execute();
   
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
    
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      
      $stmt->close();
      $conexion->close();
      return false;
    }
}

function VerifyProfeC($dni,$passwd1)
{
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM profes WHERE Dni = ? AND contrasenya = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    //$stmt->bind_param("ss", $name, $passwd);
    $stmt->bind_param("ss", $dni, $passwd);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}



function cifrarContrasena($contrasena) {
	// Sal constante (puedes cambiarla si lo deseas)
	$sal = "tu_sal_constante";

	// Concatenar la sal a la contraseña
	$contrasenaConSal = $sal . $contrasena;

	// Aplicar un algoritmo de hash (por ejemplo, sha256)
	$hash = hash('sha256', $contrasenaConSal);

	return $hash;

}

//añadir profre
function AddProfe($nom,$dni,$passwd1,$cognom,$titol,$foto,$estado) {
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    if(preg_match("/^[0-9]{8}[A-Za-z]{1}$/", $dni)){
      $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];
      $numsDni = intval(substr($dni,0,8));
      $letra = $letras[$numsDni % 23];
      if($letra == substr($dni, 8,1)){
          // Consulta SQL para insertar un nuevo profesor
          $sql = "INSERT INTO profes (Dni, Nom, Cognom, titol, foto, contrasenya, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

          try {
              $stmt = $conexion->prepare($sql);
              $stmt->execute([$dni, $nom, $cognom, $titol, $foto, $passwd, $estado]);
              echo "Profesor añadido con éxito.";
              return true;
          } catch (PDOException $e) {
              echo "Error al añadir profesor: " . $e->getMessage();
              return false;
          }

          $conexion = null; // Cerrar la conexión

      }
    }

}

//añadir curso
function AddCurso($codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final) {
  $conexion = conectarseBase();
  // Consulta SQL para insertar un nuevo curso
  $sql = "INSERT INTO cursos (Codigo, Nom, Foto, Descripcion, NumeroHoras, DataInici, Profe, Estado, DataFinal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$codigo, $nom, $foto, $descripcion, $horas, $fecha_inicio, $profe, $estado, $fecha_final]);
      echo "Curso añadido con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al añadir el curso: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

//añadir alumno
function AddAlumno($nom,$dni,$passwd1,$cognom,$edad,$foto,$estado) {
  $conexion = conectarseBase();
  $passwd=cifrarContrasena($passwd1);
  if(preg_match("/^[0-9]{8}[A-Za-z]{1}$/", $dni)){
    $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];
    $numsDni = intval(substr($dni,0,8));
    $letra = $letras[$numsDni % 23];
    if($letra == substr($dni, 8,1)){
      // Consulta SQL para insertar un nuevo profesor
      $sql = "INSERT INTO alumnes (Dni, Nom, Cognom, Edad, foto, contrasenya, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

      try {
          $stmt = $conexion->prepare($sql);
          $stmt->execute([$dni, $nom, $cognom, $edad, $foto, $passwd, $estado]);
          echo "Alumno añadido con éxito.";
          echo"<script>PremiosBuenos();</script>";
          echo('<a href="index.php">volver al menu</a>');
          return true;
      } catch (PDOException $e) {
          echo "Error al añadir Alumno: " . $e->getMessage();
          return false;
      }

        $conexion = null; // Cerrar la conexión
        }else{
          echo("dni incorrecto");
        }
    }
  
}


function VerifyProfe($dni)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM profes WHERE Dni = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("s", $dni);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}

function VerifyAlumno($dni)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM alumnes WHERE DNI = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("s", $dni);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}

function VerifyCurso($codigo)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM cursos WHERE  Codigo= ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("s", $codigo);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}

// Función para obtener la lista de profesores desde la base de datos
function obtenerListaProfesores() {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de profesores
  $sql = "SELECT Dni, Nom FROM profes";
  $result = $conexion->query($sql);

  $listaProfesores = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaProfesores[] = $row;
  }

  $conexion->close();

  return $listaProfesores;
}

function GetInfoProfe($dniProfesor, $campo) {
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM profes WHERE DNI = '$dniProfesor'";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

function GetInfoAlumno($dni, $campo) {
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM alumnes WHERE DNI = '$dni'";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

function GetInfoMatriculado($code,$dni) {
  $campo = "nota";
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM curso_alumne WHERE curso = $code and alumne = '$dni'";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

function GetInfoCurso($codigo, $campo) {
  $conexion = conectarseBase();
  $sql = "SELECT $campo FROM cursos WHERE codigo = $codigo";
  $result = $conexion->query($sql);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row[$campo];
  } else {
      return ""; 
  }
}

function verificarCursoFinalizado($codigoCurso) {
  // Conectar a la base de datos
  $conexion = conectarseBase();

  // Verificar la conexión
  if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
  }

  // Preparar la consulta SQL para obtener las fechas de inicio y finalización del curso
  $sql = "SELECT DataInici, DataFinal FROM cursos WHERE Codigo = ?";
  $stmt = $conexion->prepare($sql);
  $stmt->bind_param("i", $codigoCurso); // "i" indica que es un entero
  $stmt->execute();
  $stmt->bind_result($fechaInicio, $fechaFinal);
  $stmt->fetch();

  // Obtener la fecha actual
  $fechaActual = date("Y-m-d");

  // Verificar si la fecha actual está dentro del rango del curso
  if ($fechaActual >= $fechaInicio && $fechaActual <= $fechaFinal) {
      // El curso está en progreso
      return true;
  } else {
      // El curso ha finalizado
      return false;
  }

  // Cerrar la conexión a la base de datos
  $stmt->close();
  $conexion->close();
}



// Función para obtener la lista de cursos desde la base de datos
function obtenerListaCursos() {
  $conexion = conectarseBase();

  // Obtiene la fecha actual en el formato de MySQL (YYYY-MM-DD)
  $fechaActual = date("Y-m-d");

  // Realiza una consulta SQL para obtener la lista de cursos en los que el alumno NO está matriculado y cuya DataFinal no ha pasado
  $sql = "SELECT Codigo, Nom, Estado FROM cursos WHERE DataInici >= '$fechaActual'";

  $result = $conexion->query($sql);

  $listaCursosNoMatriculados = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaCursosNoMatriculados[] = $row;
  }

  $conexion->close();

  return $listaCursosNoMatriculados;
}

function obtenerListaCursosa1() {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de cursos en los que el alumno NO está matriculado y cuya DataFinal no ha pasado
  $sql = "SELECT Codigo, Nom, Estado FROM cursos";

  $result = $conexion->query($sql);

  $listaCursosNoMatriculados = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaCursosNoMatriculados[] = $row;
  }

  $conexion->close();

  return $listaCursosNoMatriculados;
}

function obtenerCursosMatriculados($dni) {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de cursos matriculados por el alumno
  $sql = "SELECT cursos.Codigo, cursos.Nom, cursos.Estado FROM cursos
          INNER JOIN curso_alumne ON cursos.Codigo = curso_alumne.curso
          WHERE curso_alumne.alumne = '$dni'";

  $result = $conexion->query($sql);

  $listaCursosMatriculados = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaCursosMatriculados[] = $row;
  }

  $conexion->close();

  return $listaCursosMatriculados;
}

function obtenerCursosPorProfesor($idProfesor) {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de cursos que imparte el profesor
  $sql = "SELECT Codigo, Nom, Estado FROM cursos WHERE Profe = '$idProfesor'";

  $result = $conexion->query($sql);

  $listaCursosPorProfesor = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaCursosPorProfesor[] = $row;
  }

  $conexion->close();

  return $listaCursosPorProfesor;
}

function obtenerCursosNoMatriculados($dni) {
  $conexion = conectarseBase();

  // Obtiene la fecha actual en el formato de MySQL (YYYY-MM-DD)
  $fechaActual = date("Y-m-d");

  // Realiza una consulta SQL para obtener la lista de cursos en los que el alumno NO está matriculado y cuya DataFinal no ha pasado
  $sql = "SELECT Codigo, Nom, Estado FROM cursos
          WHERE Codigo NOT IN (SELECT curso FROM curso_alumne WHERE alumne = '$dni')
          AND DataInici >= '$fechaActual'";

  $result = $conexion->query($sql);

  $listaCursosNoMatriculados = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaCursosNoMatriculados[] = $row;
  }

  $conexion->close();

  return $listaCursosNoMatriculados;
}

function imprimirCursosProfes($rol,$dni) {
  // Obtener la lista de cursos utilizando la función anterior
  $cursos = obtenerCursosPorProfesor($_SESSION['dni']);
  if($cursos==NULL){
    echo("No hay cursos");
  }else{
    // Iniciar la sesión si aún no está iniciada
  if (!isset($_SESSION)) {
    session_start();
  }

  // Recorrer la lista de cursos y mostrar los nombres y las fotos
  foreach ($cursos as $curso) {
    $codigo = $curso['Codigo'];
    $nombre = $curso['Nom'];
    $estado = $curso['Estado'];
    
    $imagenURL = "admin/fotos/$codigo.jpg";
    if($estado==1){
      echo "<div class='cursos'>";
      echo "<div class='FotoCurso'>";
      echo "<img src='$imagenURL' alt='$nombre'><br>";
      echo "</div>";
      echo "<div class='CursoText'>";
      echo "<div class='TextoCurso'>";
      echo "<h2 class='titulo'>$nombre</h2>";
      echo "</div>";
      echo "<div class='InfoCurso'>";
      echo "<img src='imgg/onlinee.png'<br>";
      echo "<img src='imgg/idioma.png'<br>";
      echo "</div>";
      echo "</div>";
      
    
      // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
      echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

      if ($rol == "alumne") {
        echo "<button class='flecha'><img src='img/flecha.png' alt='fecha'></button>";
      } else {
        echo "<button class='flecha'><img src='img/flecha.png' alt='fecha'></button>";
      }
    
      echo "</a>";
      echo "</div>";

    }
    
  }
  }
  
}

function imprimirCursos($rol,$dni) {
  // Obtener la lista de cursos utilizando la función anterior
  $cursos = obtenerCursosMatriculados($dni);

  // Iniciar la sesión si aún no está iniciada
  if (!isset($_SESSION)) {
    session_start();
  }

  // Recorrer la lista de cursos y mostrar los nombres y las fotos
  foreach ($cursos as $curso) {
    $codigo = $curso['Codigo'];
    $nombre = $curso['Nom'];
    $estado = $curso['Estado'];
    
    $imagenURL = "admin/fotos/$codigo.jpg";
    if($estado==1){
      echo "<div class='cursos'>";
      echo "<div class='FotoCurso'>";
      echo "<img src='$imagenURL' alt='$nombre'><br>";
      echo "</div>";
      echo "<div class='CursoText'>";
      echo "<div class='TextoCurso'>";
      echo "<h2 class='titulo'>$nombre</h2>";
      echo "</div>";
      echo "<div class='InfoCurso'>";
      echo "<img src='imgg/onlinee.png'<br>";
      echo "<img src='imgg/idioma.png'<br>";
      echo "</div>";
      echo "</div>";
      
    
      // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
      echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

      if ($rol == "alumne") {
        echo "<button class='flecha'><img src='img/flecha.png' alt='fecha'></button>";
      } else {
        echo "<button class='flecha'>mi curso</button>";
      }
    
      echo "</a>";
      echo "</div>";

    }
    
  }
}

function imprimirCursosNoMatriculados($rol,$dni) {
  // Obtener la lista de cursos utilizando la función anterior
  $cursos = obtenerCursosNoMatriculados($dni);

  // Iniciar la sesión si aún no está iniciada
  if (!isset($_SESSION)) {
    session_start();
  }

  // Recorrer la lista de cursos y mostrar los nombres y las fotos
  foreach ($cursos as $curso) {
    $codigo = $curso['Codigo'];
    $nombre = $curso['Nom'];
    $estado = $curso['Estado'];
    
    $imagenURL = "admin/fotos/$codigo.jpg";
    if($estado==1){
      echo "<div class='cursos'>";
      echo "<div class='FotoCurso'>";
      echo "<img src='$imagenURL' alt='$nombre'><br>";
      echo "</div>";
      echo "<div class='CursoText'>";
      echo "<div class='TextoCurso'>";
      echo "<h2 class='titulo'>$nombre</h2>";
      echo "</div>";
      echo "<div class='InfoCurso'>";
      echo "<img src='imgg/onlinee.png'<br>";
      echo "<img src='imgg/idioma.png'<br>";
      echo "</div>";
      echo "</div>";
      
    
      // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
      echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

      if ($rol == "alumne") {
        echo "<button class='flecha'><img src='img/flecha.png' alt='fecha'></button>";
      } else {
        echo "<button class='flecha'>mi curso</button>";
      }
    
      echo "</a>";
      echo "</div>";

    }
    
  }
}


// function imprimirCursosSin() {
//   // Obtener la lista de cursos utilizando la función anterior
//   $cursos = obtenerListaCursos();

//   // Iniciar la sesión si aún no está iniciada
//   if (!isset($_SESSION)) {
//     session_start();
//   }

//   // Recorrer la lista de cursos y mostrar los nombres y las fotos
//   foreach ($cursos as $curso) {
//     $codigo = $curso['Codigo'];
//     $nombre = $curso['Nom'];
//     $estado = $curso['Estado'];
    
//     $imagenURL = "admin/fotos/$codigo.jpg";
//     if($estado==1){
//       echo "<div class='cursos'>";
//       echo "<div class='FotoCurso'>";
//       echo "<img src='$imagenURL' alt='$nombre'><br>";
//       echo "</div>";
//       echo "<div class='CursoText'>";
//       echo "<div class='TextoCurso'>";
//       echo "<h2 class='titulo'>$nombre</h2>";
//       echo "</div>";
//       echo "<div class='InfoCurso'>";
//       echo "<img src='imgg/onlinee.png'<br>";
//       echo "<img src='imgg/idioma.png'<br>";
//       echo "</div>";
//       echo "</div>";
      
    
//       // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
//       echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

  
//       echo "<button class='flecha'><img src='img/flecha.png' alt='fecha'></button>";
     
    
//       echo "</a>";
     
      
//       echo"</div>";
      
//     }
//   }
// }
function imprimirCursosSin() {
  // Obtener la lista de cursos utilizando la función anterior
  $cursos = obtenerListaCursos();

  // Iniciar la sesión si aún no está iniciada
  if (!isset($_SESSION)) {
    session_start();
  }

  // Recorrer la lista de cursos y mostrar los nombres y las fotos
  foreach ($cursos as $curso) {
    $codigo = $curso['Codigo'];
    $nombre = $curso['Nom'];
    $estado = $curso['Estado'];
    
    $imagenURL = "admin/fotos/$codigo.jpg";
    if($estado==1){
      echo "<div class='cursos'>";
      echo "<div class='FotoCurso'>";
      echo "<img src='$imagenURL' alt='$nombre'><br>";
      echo "</div>";
      echo "<div class='CursoText'>";
      echo "<div class='TextoCurso'>";
      echo "<h2 class='titulo'>$nombre</h2>";
      echo "</div>";
      echo "<div class='InfoCurso'>";
      echo "<img src='imgg/onlinee.png' alt='foto'><br>";
      echo "<img src='imgg/idioma.png' alt='foto'><br>";
      echo "</div>";
      echo "</div>";
      
    
      // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
      echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

  
      echo "<div class='flecha'><img src='img/flecha.png' alt='fecha'></div>";
     
    
      echo "</a>";
     
      
      echo"</div>";
      
    }
  }
}

function InfoCurso($code){
  
  $imagenURL = "../admin/fotos/$code.jpg";
  echo "<div class='CursoContenedor'>";
  echo "<div class='colorImg'>";
  echo "<div class='CursoCompletoIng'>";
  echo "<img src='$imagenURL' alt='foto curso' width='200'><br>";
  
  echo("<h1>". GetInfoCurso($code, 'Nom') ."</h1>");
  echo "</div>";
  echo "<div class='fotosCompleto'>";
  echo "<img src='../imgg/onlinee.png' alt='logo'>";
  echo "<img src='../imgg/idioma.png' alt='logo'>";
  echo "</div>";
  echo "<p class='fechas'> Inicio: " . GetInfoCurso($code, 'DataInici')."</p>";
  echo "<p class='fechas'>Final: " . GetInfoCurso($code, 'DataFinal')."</p>";
  echo("<p class='descripcion'>". GetInfoCurso($code, 'Descripcion') ."</p>");
  if (isset($_SESSION['dni'])) {
    if(VerifyMatriculado($code,$_SESSION['dni'])){
      echo("<p class='notaCurso'>Estas matriculado</p>");
      if(GetInfoMatriculado($code,$_SESSION['dni'])){
        echo("<div class='notaAlumne'>");
        echo(GetInfoMatriculado($code,$_SESSION['dni']));
        echo("</div>");
      }else{
        echo("<p class='notaCurso'>Nota no disponible</p>");
      }
      echo'<form method="POST" action="CursoAlumne.php" enctype="multipart/form-data">';
      echo"<input type='hidden' name='codigo_curso' value=". $code .">";
      echo'<button type="submit" class="botonCurso" name="botonB" value="borrar">Darte de baja?</button>';
      echo'</from>';

    }else{
      echo'<form method="POST" action="CursoAlumne.php" enctype="multipart/form-data">';
      echo"<input type='hidden' name='codigo_curso' value=". $code .">";
      echo'<button type="submit" class="botonCurso" name="botonM" value="apuntar">Apuntar</button>';
      echo'</from>';
      
     
    }

   
  }
  echo"</div>";
  echo"</div>";

  
}
function InfoCursoProfe($code){
  
  $imagenURL = "../admin/fotos/$code.jpg";
  echo "<div class='CursoContenedor'>";
  echo "<div class='colorImg'>";
  echo "<div class='CursoCompletoIng'>";
  echo "<img src='$imagenURL' alt='foto curso' width='200'><br>";
  
  echo("<h1>". GetInfoCurso($code, 'Nom') ."</h1>");
  $alumnos = obtenerDatosAlumnosPorCurso($code); 
  if(is_array($alumnos) && count($alumnos) >0){


    if(verificarCursoFinalizado($code)){
     
      mostrarTablaNotasAlumnos($alumnos,$code);
    }else{
     
      mostrarTablaNotasAlumnosSinNota($alumnos,$code);
    }

    
  }else{
    echo "No hay alumnos";
  }
  
  echo("</div>");
  echo("</div>");
  echo "</div>";

  
  }

function VerifyMatriculado($code,$dni)
{
    $conexion = conectarseBase();
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM curso_alumne WHERE  curso= ? and alumne= ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    $stmt->bind_param("ss", $code,$dni);


    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron registros
    if ($result->num_rows > 0) {
      // Las credenciales son válidas
      $stmt->close();
      $conexion->close();
      return true;
    } else {
      // Las credenciales son inválidas
      $stmt->close();
      $conexion->close();
      return false;
    }
}

function MatricularCurso($code,$dni) {
  
  // Obtener la fecha actual
  $fechaActual = new DateTime();
 
  // Obtener las fechas de inicio y finalización
  
  $Final = new DateTime(GetInfoCurso($code, 'DataFinal'));

  // Verificar si la fecha actual está entre las fechas de inicio y finalización
  if ($fechaActual <= $Final) {
    // La fecha actual está dentro del rango
    InsertAlumneCurso($dni,$code);
    
  } else {
    // La fecha actual no está dentro del rango
    echo("El curs esta fora de termini");
    return "false";
    

  }
}

function BorrarAlumneCurso($dni, $code) {
  $conexion = conectarseBase();
 
  $sql = "DELETE FROM curso_alumne WHERE curso = ? AND alumne = ?";
 
  try {
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $code, $dni); // "ss" indica que ambos valores son strings
    $stmt->execute();
    header("refresh:1;url=../index.php");
    return true;
  } catch (PDOException $e) {
    echo "Error al eliminar el registro: " . $e->getMessage();
    header("refresh:2;url=../index.php");
    return false;
  }
}

function InsertAlumneCurso($dni,$code){
  $conexion = conectarseBase();
  
  $sql = "INSERT INTO curso_alumne (curso, alumne) VALUES (?, ?)";
  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$code, $dni]);
    header("refresh:1;url=../index.php");
    return true;
  }catch (PDOException $e) {
    echo "Error al  matricular: " . $e->getMessage();
    header("refresh:2;url=../index.php");
    return false;
}
}


function UpdateAlumne($nom, $dni, $cognom, $edad) {
  $conexion = conectarseBase();
  // Consulta SQL para actualizar un profesor
  $sql = "UPDATE alumnes SET Nom = ?, Cognom = ?, Edad = ? WHERE DNI = ?";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom, $cognom, $edad, $dni]);
      echo "Profesor actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar profesor: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

function UpdateProfe($nom, $dni, $cognom, $titol ,$estado) {
  $conexion = conectarseBase();
  // Consulta SQL para actualizar un profesor
  $sql = "UPDATE profes SET Nom = ?, Cognom = ?, titol = ?, estado = ? WHERE Dni = ?";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom, $cognom, $titol, $estado, $dni]);
      echo "Profesor actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar profesor: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

function UpdateProfeyou($nom, $dni, $cognom, $titol ) {
  $conexion = conectarseBase();
  // Consulta SQL para actualizar un profesor
  $sql = "UPDATE profes SET Nom = ?, Cognom = ?, titol = ? WHERE Dni = ?";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom, $cognom, $titol, $dni]);
      echo "Profesor actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar profesor: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}


function UpdateCurso($codigo,$nom,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final) {
  $conexion = conectarseBase();
  // Consulta SQL para insertar un nuevo profesor
  $sql = "UPDATE cursos SET Nom = ?, Descripcion = ?, NumeroHoras = ?, DataInici = ?, Profe = ?, Estado = ?, DataFinal = ? WHERE Codigo = ?";
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final,$codigo]);
      echo "Curso actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar el curso: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}
function UpdateFotoCurso($code, $foto) {
  $conexion = conectarseBase();

  // Consulta SQL para actualizar la foto de un alumno
  $sql = "UPDATE cursos SET Foto = ? WHERE Codigo = ?";

  try {
      // Convertir el DNI a cadena
      $dni = strval($code);

      $stmt = $conexion->prepare($sql);
      $stmt->execute([$foto, $code]);
      echo "Foto del curso actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la foto del curso: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

function UpdateContrasenaProfe($dni, $passwd1) {
  $conexion = conectarseBase();
  $passwd = cifrarContrasena($passwd1);
 
  // Consulta SQL para actualizar la contraseña de un profesor
  $sql = "UPDATE profes SET contrasenya = ? WHERE Dni = ?";
 
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$passwd, $dni]);
      echo "Contraseña del profesor actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la contraseña del profesor: " . $e->getMessage();
      return false;
  }
 
  $conexion = null; // Cerrar la conexión
}

function UpdateContrasenaAlumne($dni, $passwd1) {
  $conexion = conectarseBase();
  $passwd = cifrarContrasena($passwd1);
 
  // Consulta SQL para actualizar la contraseña de un profesor
  $sql = "UPDATE alumnes SET Contrasenya = ? WHERE DNI = ?";
 
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$passwd, $dni]);
      echo "Contraseña del profesor actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la contraseña del profesor: " . $e->getMessage();
      return false;
  }
 
  $conexion = null; // Cerrar la conexión
}

function UpdateFotoAlumne($dni, $foto) {
  $conexion = conectarseBase();

  // Consulta SQL para actualizar la foto de un alumno
  $sql = "UPDATE alumnes SET Foto = ? WHERE DNI = ?";

  try {
      // Convertir el DNI a cadena
      $dni = strval($dni);

      $stmt = $conexion->prepare($sql);
      $stmt->execute([$foto, $dni]);
      echo "Foto del alumno actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la foto del alumno: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

function UpdateFotoProfe($dni, $foto) {
  $conexion = conectarseBase();
  echo("fottttttttoooo");
  // Consulta SQL para actualizar la foto de un alumno
  $sql = "UPDATE profes SET Foto = ? WHERE Dni = ?";

  try {
      // Convertir el DNI a cadena
      $dni = strval($dni);

      $stmt = $conexion->prepare($sql);
      $stmt->execute([$foto, $dni]);
      echo "Foto del profe actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la foto del profe: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}

function adapImage($data,$name,$tmpname){
  $imagename = $name;
  $extension = pathinfo($imagename, PATHINFO_EXTENSION);
  $image = $data . "." . $extension;
  $image_tmp = $tmpname;
  $image_path = "fotos/".$image;
  move_uploaded_file($image_tmp,$image_path);
  return $image;
}

function adapImageProfes($data,$name,$tmpname){
  $imagename = $name;
  $extension = pathinfo($imagename, PATHINFO_EXTENSION);
  $image = $data . "." . $extension;
  $image_tmp = $tmpname;
  $image_path = "../admin/fotos/".$image;
  move_uploaded_file($image_tmp,$image_path);
  return $image;
}

function mostrarNotasCursos($dni) {
  $conexion = conectarseBase();

  // Consultar los cursos y las notas del alumno
  $sql = "SELECT curso, nota FROM curso_alumne WHERE alumne = ?";
 
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->bind_param("s", $dni);
      $stmt->execute();
     
      // Obtener el resultado del statement
      $result = $stmt->get_result();

      // Verificar si hay registros
      if ($result->num_rows > 0) {
          // Imprimir la tabla
          echo '<table id="notas_alumno">';
          echo '<tr><th>Curso</th><th>Nota</th></tr>';
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . GetInfoCurso($row['curso'],"Nom"). '</td>';
              echo '<td>' . ($row['nota'] !== null ? htmlspecialchars($row['nota']) : 'Nota no disponible') . '</td>';
              echo '</tr>';
          }
          echo '</table>';
      } else {
          // Mostrar un mensaje si no hay registros
          echo 'No se encontraron cursos.';
      }
     
      $result->close();  // Cerrar el resultado
      $stmt->close();    // Cerrar el statement
     
  } catch (Exception $e) {
      echo "Error al obtener las notas: " . $e->getMessage();
  }
}

function obtenerDatosAlumnosPorCurso($codigoCurso) {
  $conexion = conectarseBase();
  // Verificar la conexión
  if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
  }

  // Preparar la consulta SQL con un marcador de posición para el código del curso
  $sql = "SELECT a.DNI, a.Nom, ca.nota, c.Nom as NombreCurso
          FROM curso_alumne ca
          INNER JOIN alumnes a ON ca.alumne = a.DNI
          INNER JOIN cursos c ON ca.curso = c.Codigo
          WHERE ca.curso = ?"; // Marcador de posición para el código del curso

  // Preparar la consulta con el marcador de posición
  $stmt = $conexion->prepare($sql);

  // Asociar el código del curso al marcador de posición
  $stmt->bind_param("i", $codigoCurso); // "i" indica que es un entero

  // Ejecutar la consulta
  $stmt->execute();

  // Obtener resultados
  $result = $stmt->get_result();

  $alumnos = array();
  // Obtener datos de los alumnos
  while ($row = $result->fetch_assoc()) {
      $alumnos[] = $row;
  }
  return $alumnos;
}

function mostrarTablaNotasAlumnos($alumnos,$code) {
  echo "<div class='NotasTabla'>";
  echo "<h2>Notas de Alumnos</h2>";
  echo "<form method='post' action='CursoAlumne.php?codigo_curso=$code'>"; 
  echo "<table class='TablaNotas'>
          <tr>
              <th>Nombre</th>
              <th>Nota</th>
          </tr>";

  foreach ($alumnos as $alumno) {
      $nombre = $alumno['Nom']; // Reemplaza 'nombre' con el nombre del campo en tu base de datos
      $nota = $alumno['nota']; // Reemplaza 'nota' con el nombre del campo en tu base de datos

      echo "<tr>
              <td>$nombre</td>
              <td><input type='number' min='0' max='10' name='notas[$nombre]' value='$nota'></td>
            </tr>";
  }

  echo "</table>";
  echo "<input type='submit' class='botonNotas' value='Guardar Notas'>";
  echo "</form>";
  echo "</div>";
}
function mostrarTablaNotasAlumnosSinNota($alumnos,$code){
  echo "<div class='NotasTabla'>";
  echo "<h2>Notas de Alumnos</h2>";
  echo "<form method='post' action='CursoAlumne.php?codigo_curso=$code'>"; 
  echo "<table class='TablaNotas'>
          <tr>
              <th>Nombre</th>
              <th>Nota</th>
          </tr>";

  foreach ($alumnos as $alumno) {
      $nombre = $alumno['Nom']; // Reemplaza 'nombre' con el nombre del campo en tu base de datos

      echo "<tr>
              <td>$nombre</td>
            </tr>";
  }

  echo "</table>";
 // echo "<input type='submit' value='Guardar Notas'>";
  echo "</form>";
  echo "</div>";
}


?>
