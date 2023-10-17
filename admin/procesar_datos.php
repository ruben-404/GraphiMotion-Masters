<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$datosEstudiantes = json_decode(file_get_contents("php://input"), true);

	print_r($datosEstudiantes);
    // Conectarse a la base de datos y procesar los datos
    $conexion = new mysqli("localhost", "root", "", "learning-academy");
	
    // Verificar la conexión
    if ($conexion->connect_error) {
   	 die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta para insertar estudiantes
    $sqlEstudiante = $conexion->prepare("INSERT INTO alumnes (DNI, Nom, Cognom, Edad, Foto, Contrasenya, estado) VALUES (?,?,?,?,?,?,?)");
    $sqlMatricula = $conexion->prepare("INSERT INTO curso_alumne (curso, alumne) VALUES (?, ?)");

   

    foreach ($datosEstudiantes['estudiantes'] as $estudiante) {
		
   	 // Acceder a los elementos del array
	 print_r($estudiante);
   	 $DNI = $estudiante[0];
   	 $Nom = $estudiante[1];
   	 $Cognom = $estudiante[2];
   	 $Edad = $estudiante[3];
   	 $Foto = $estudiante[4];
	 $estado = 1;
   	 $idCursos = explode(',', $estudiante[6]); // Convertir la lista de cursos en un array

   	 // Hash de la contraseña
   	 $contrasena = 123; // Implementa esta función
   	 $sal = "tu_sal_constante";

	// Concatenar la sal a la contraseña
	$contrasenaConSal = $sal . $contrasena;

	// Aplicar un algoritmo de hash (por ejemplo, sha256)
	$hash = hash('sha256', $contrasenaConSal);




	$sqlEstudiante->bind_param("sssssss", $DNI, $Nom, $Cognom, $Edad, $Foto, $hash, $estado);
	
   	 // Insertar estudiante
   	 $sqlEstudiante->execute();
   	 

   	 // Matricular al estudiante en los cursos indicados
   	 foreach ($idCursos as $idCurso) {
		 $sqlMatricula->bind_param("ii", $idCurso, $DNI);
   		 $sqlMatricula->execute();
   	 }
    }

    // Cerrar las consultas y la conexión a la base de datos
    $sqlEstudiante->close();
    $sqlMatricula->close();
    $conexion->close();

    echo json_encode(["message" => "Datos insertados correctamente en la base de datos."]);
} else {
	echo("error");
    http_response_code(405); // Método no permitido
    echo json_encode(["error" => "Método no permitido."]);
}


?>
