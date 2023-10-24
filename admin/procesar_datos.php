<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");


function conectarseBase()
{
    $conexion = mysqli_connect("localhost", "root", "", "learning-academy");
    if (!$conexion) {
        mysqli_connect_error();
        echo("error");

    }
    return $conexion;
}
function VerifyAlumnoc($dni)
{
    $conexion = conectarseBase();
    
    
    // Preparar la consulta SELECT
    $sql = "SELECT * FROM alumnes WHERE DNI = ?";

    // Preparar la sentencia SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros de la sentencia SQL
    //$stmt->bind_param("ss", $name, $passwd);
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$datosEstudiantes = json_decode(file_get_contents("php://input"), true);
	$AlumnosInsertados = false;

	
    // Conectarse a la base de datos y procesar los datos
    $conexion = conectarseBase();
	
    // Verificar la conexión
    if ($conexion->connect_error) {
   	 die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta para insertar estudiantes
    $sqlEstudiante = $conexion->prepare("INSERT INTO alumnes (DNI, Nom, Cognom, Edad, Foto, Contrasenya, estado) VALUES (?,?,?,?,?,?,?)");
    $sqlMatricula = $conexion->prepare("INSERT INTO curso_alumne (curso, alumne) VALUES (?, ?)");

   

    foreach ($datosEstudiantes['estudiantes'] as $estudiante) {
		
   	 // Acceder a los elementos del array
   	 $DNI = $estudiante[0];
   	 $Nom = $estudiante[1];
   	 $Cognom = $estudiante[2];
   	 $Edad = $estudiante[3];
   	 $Foto = $estudiante[4];
	 $estado = 1;
   	 $idCursos = explode(',', $estudiante[5]); // Convertir la lista de cursos en un array

   	 // Hash de la contraseña
   	 $contrasena = 123; // Implementa esta función
   	 $sal = "tu_sal_constante";

	// Concatenar la sal a la contraseña
	$contrasenaConSal = $sal . $contrasena;

	// Aplicar un algoritmo de hash (por ejemplo, sha256)
	$hash = hash('sha256', $contrasenaConSal);



	
	$sqlEstudiante->bind_param("sssssss", $DNI, $Nom, $Cognom, $Edad, $Foto, $hash, $estado);
	
   	 // Insertar estudiante
	 if(VerifyAlumnoc($DNI)){
		echo "El alumno con DNI: " .$DNI . " ya existe<br>";
		continue;
	 }else{
		$sqlEstudiante->execute();
		$AlumnosInsertados = True;
	 }
   	 
		
   	 

   	 // Matricular al estudiante en los cursos indicados
   	 foreach ($idCursos as $idCurso) {
		$sqlMatricula->bind_param("ii", $idCurso, $DNI);
		if(!$sqlMatricula->execute()){
			$error = $sqlMatricula->errorInfo();
			echo "Error en la consulta SQL:<br>" .$error[2];
		}
   	 }
    }

    // Cerrar las consultas y la conexión a la base de datos
    $sqlEstudiante->close();
    $sqlMatricula->close();
    $conexion->close(); 
	if($AlumnosInsertados){
		echo "Datos agregados<br>";
	}
    
} else {
	echo("error");
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Método no permitido."]);
}


?>
