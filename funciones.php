<?php
function conectarseBase()
{
    $conexion = mysqli_connect("localhost", "root", "", "learning-academy");
    if (!$conexion) {
        mysqli_connect_error();
        echo("error");

    }
    return $conexion;
}

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

function VerifyAlumnoc($dni,$passwd1)
{
    $conexion = conectarseBase();
    $passwd=cifrarContrasena($passwd1);
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM alumnes WHERE DNI = ? AND Contrasenya = ?";

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
  // Consulta SQL para insertar un nuevo profesor
  $sql = "INSERT INTO alumnes (Dni, Nom, Cognom, Edad, foto, contrasenya, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$dni, $nom, $cognom, $edad, $foto, $passwd, $estado]);
      echo "Alumno añadido con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al añadir Alumno: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
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
  $sql = "SELECT $campo FROM Profes WHERE DNI = $dniProfesor";
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
  $sql = "SELECT $campo FROM alumnes WHERE DNI = $dni";
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
  $sql = "SELECT $campo FROM curso_alumne WHERE curso = $code and alumne = $dni";
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

// Función para obtener la lista de profesores desde la base de datos
function obtenerListaCursos() {
  $conexion = conectarseBase();

  // Realiza una consulta SQL para obtener la lista de profesores
  $sql = "SELECT Codigo, Nom FROM cursos";
  $result = $conexion->query($sql);

  $listaProfesores = array();

  // Recorre los resultados y los almacena en un arreglo
  while ($row = $result->fetch_assoc()) {
      $listaProfesores[] = $row;
  }

  $conexion->close();

  return $listaProfesores;
}
function imprimirCursos($rol) {
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
    $imagenURL = "admin/fotos/$codigo.jpg"; // Reemplaza con la ruta real de tus imágenes
    echo "<div class='cursos'>";
    echo "<h2>$nombre</h2>";
    echo "<img src='$imagenURL' alt='$nombre' width='200'><br>";
    echo "<img src='imgg/onlinee.png'<br>";
    echo "<img src='imgg/idioma.png'<br>";
   
    // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
    echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

    if ($rol == "alumne") {
      echo "<button>flecha</button>";
    } else {
      echo "<button>mi curso</button>";
    }
   
    echo "</a>";
    echo "</div>";
  }
}

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
    $imagenURL = "admin/fotos/$codigo.jpg"; // Reemplaza con la ruta real de tus imágenes
    echo "<div class='cursos'>";
    echo "<h2>$nombre</h2>";
    echo "<img src='$imagenURL' alt='$nombre' width='200'><br>";
    echo "<img src='imgg/onlinee.png'<br>";
    echo "<img src='imgg/idioma.png'<br>";
   
    // Agregar un enlace al archivo CursoAlumne.php con el código del curso en la URL
    echo "<a href='alumno/CursoAlumne.php?codigo_curso=$codigo'>";

    echo "<button>flecha</button>";
    
   
    echo "</a>";
    echo "</div>";
  }
}

function InfoCurso($code){
  
  $imagenURL = "../admin/fotos/$code.jpg";
  echo "<img src='$imagenURL' alt='foto curso' width='200'><br>";
  echo("<h1>". GetInfoCurso($code, 'Nom') ."</h1>");
  echo "<img src='../imgg/onlinee.png'>";
  echo "<img src='../imgg/idioma.png'>";
  echo("<p>". GetInfoCurso($code, 'Descripcion') ."</p>");
  if (isset($_SESSION['dni'])) {
    if(VerifyMatriculado($code,$_SESSION['dni'])){
      echo("esta matriculado");
      if(GetInfoMatriculado($code,$_SESSION['dni'])){
        echo(GetInfoMatriculado($code,$_SESSION['dni']));
       
      }else{
        echo("Nota no disponible");
      }
      echo'<form method="POST" action="CursoAlumne.php" enctype="multipart/form-data">';
      echo"<input type='hidden' name='codigo_curso' value=". $code .">";
      echo'<button type="submit" name="botonB" value="borrar">Darte de baja?</button>';
      echo'</from>';

      //echo "<button id='DarBajaBtn' data-curso-id='$code' data-dni-id='{$_SESSION['dni']}'>Darte de baja?</button>";
    }else{
      echo'<form method="POST" action="CursoAlumne.php" enctype="multipart/form-data">';
      echo"<input type='hidden' name='codigo_curso' value=". $code .">";
      echo'<button type="submit" name="botonM" value="apuntar">Apuntar</button>';
      echo'</from>';
      //echo "<button id='matricularBtn' data-curso-id='$code'>mi curso</button>";
      //quitar esto cuando se capaz de poner enlazar una funcion php con un puto boton
     
    }
   
  }
  
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
    echo "Registro eliminado con éxito.";
    return true;
  } catch (PDOException $e) {
    echo "Error al eliminar el registro: " . $e->getMessage();
    return false;
  }
}

function InsertAlumneCurso($dni,$code){
  $conexion = conectarseBase();
  
  $sql = "INSERT INTO curso_alumne (curso, alumne) VALUES (?, ?)";
  try {
    $stmt = $conexion->prepare($sql);
    $stmt->execute([$code, $dni]);
    echo "matriculado con éxito.";
    return true;
  }catch (PDOException $e) {
    echo "Error al  matricular: " . $e->getMessage();
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

function UpdateProfe($nom, $dni, $cognom, $titol, $foto ,$estado) {
  $conexion = conectarseBase();
  // Consulta SQL para actualizar un profesor
  $sql = "UPDATE profes SET Nom = ?, Cognom = ?, titol = ?, foto = ? ,estado = ? WHERE Dni = ?";

  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom, $cognom, $titol, $foto, $estado, $dni]);
      echo "Profesor actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar profesor: " . $e->getMessage();
      return false;
  }

  $conexion = null; // Cerrar la conexión
}


function UpdateCurso($codigo,$nom,$foto,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final) {
  $conexion = conectarseBase();
  // Consulta SQL para insertar un nuevo profesor
  $sql = "UPDATE cursos SET Nom = ?, Foto = ?, Descripcion = ?, NumeroHoras = ?, DataInici = ?, Profe = ?, Estado = ?, DataFinal = ? WHERE Codigo = ?";
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$nom,$foto,$descripcion,$horas,$fecha_inicio,$profe,$estado,$fecha_final,$codigo]);
      echo "Curso actualizado con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar el curso: " . $e->getMessage();
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

  // Consulta SQL para actualizar la contraseña de un profesor
  $sql = "UPDATE alumnes SET Foto = ? WHERE DNI = ?";
 
  try {
      $stmt = $conexion->prepare($sql);
      $stmt->execute([$foto, $dni]);
      echo "foto del profesor actualizada con éxito.";
      return true;
  } catch (PDOException $e) {
      echo "Error al actualizar la foto del profesor: " . $e->getMessage();
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
          echo '<table border="1">';
          echo '<tr><th>Curso</th><th>Nota</th></tr>';
          while ($row = $result->fetch_assoc()) {
              echo '<tr>';
              echo '<td>' . htmlspecialchars($row['curso']) . '</td>';
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


?>