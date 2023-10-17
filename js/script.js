function mostrarEnlaces() {
    var enlacesUsuario = document.getElementById('enlaces-usuario');
    if (enlacesUsuario.style.display === 'none') {
        enlacesUsuario.style.display = 'block';
    } else {
        enlacesUsuario.style.display = 'none';
    }
}
// Captura el clic del botón con el ID 'matricularBtn' y obtén el valor del atributo de datos 'data-curso-id'
$('#matricularBtn').on('click', function() {
    // Obtiene el valor del atributo de datos 'data-curso-id' del botón
    var cursoId = $(this).data('curso-id');
    // Llama a la función matricularCurso con el ID del curso como argumento
    MatricularCursojs(cursoId);
});

function MatricularCursojs(cursoId) {
    console.log(cursoId)
    $.ajax({
        url: '../funciones.php',
        method: 'POST',
        data: { action: 'MatricularCurso', cursoId: cursoId },
    });
}




//dar de baja
 // Captura el clic del botón con el ID 'matricularBtn' y obtén el valor del atributo de datos 'data-curso-id'
 $('#DarBajaBtn').on('click', function() {
    // Obtiene el valor del atributo de datos 'data-curso-id' del botón
    var cursoId = $(this).data('curso-id');
    var Dni = $(this).data('dni-id');
    console.log(cursoId);
    console.log(Dni);
    // Llama a la función matricularCurso con el ID del curso como argumento
    BorrarAlumnesjs(Dni,cursoId);
});

function BorrarAlumnesjs(Dni,cursoId) {
    $.ajax({
        url: '../funciones.php',
        method: 'POST',
        data: { action: 'BorrarAlumnes',dni: Dni  ,code: cursoId },
    });
}
function toggleContrasena() {
    var contrasenyaInput = document.getElementById("contrasenya");
    var cambiarContrasenaBtn = document.getElementById("cambiarContrasenaBtn");
   
    if (contrasenyaInput.style.display === "none") {
        contrasenyaInput.style.display = "block";
        cambiarContrasenaBtn.innerText = "Cancelar Cambio de Contraseña";
    } else {
        contrasenyaInput.style.display = "none";
        cambiarContrasenaBtn.innerText = "Cambiar Contraseña";
    }
}

function procesarArchivo(event) {
	const archivo = event.target.files[0];
	const lector = new FileReader();
	lector.onload = function(e) {
    	const contenido = e.target.result;
    	const estudiantes = contenido.split(';');
    	const tabla = document.getElementById('tablaEstudiantes');

    	estudiantes.forEach(estudiante => {
        	const datosEstudiante = estudiante.split(',');

        	const fila = tabla.insertRow();
        	for (let i = 0; i < datosEstudiante.length; i++) {
            	const celda = fila.insertCell();
            	celda.textContent = datosEstudiante[i];
        	}
    	});
	};

	lector.readAsText(archivo);
}
/*
function enviarDatosEstudiantes() {
	const archivoInput = document.getElementById('archivoInput');
	const archivo = archivoInput.files[0];

	const lector = new FileReader();

	lector.onload = function(e) {
    	const contenido = e.target.result;
    	const estudiantes = contenido.split('\n'); // Suponiendo que los datos están separados por saltos de línea en el archivo CSV

    	// Procesar los datos del archivo y construir el array de estudiantes
    	const datosEstudiantes = estudiantes.map(estudiante => {
        	const campos = estudiante.split(',');
        	return campos.map(campo => campo.trim());
    	});
		console.log(datosEstudiantes);
    	// Enviar datos al servidor
    	fetch('procesar_datos.php', {
        	method: 'POST',
        	body: JSON.stringify({ estudiantes: datosEstudiantes }),
        	headers: {
            	'Content-Type': 'application/json'
        	}
    	})
    	.then(response => response.text())
    	.then(data => {
        	console.log(data); // Muestra la respuesta del servidor en la consola del navegador
    	});
	};

	lector.readAsText(archivo);
}
*/
function enviarDatosEstudiantes() {
    const archivoInput = document.getElementById('archivoInput');
    const archivo = archivoInput.files[0];

    const lector = new FileReader();

    lector.onload = function(e) {
   	 const contenido = e.target.result;
   	 const estudiantes = contenido.split(';');

   	 const datosEstudiantes = estudiantes.map(estudiante => {
   		 const camposSin = estudiante.split('(');
   		 const campos = camposSin[0].split(','); 
   		 let codigos = camposSin[1] ? camposSin[1].replace(')', '').trim() : ''; // Obtener códigos entre paréntesis sin paréntesis y sin espacios
   		 codigos = codigos ? codigos.split(',').join(',') : ''; // Eliminar espacios y unir códigos con comas

   		 // Devolver el array de campos y códigos sin espacios alrededor
   		 return [...campos.map(campo => campo.trim()), codigos];
   	 });

   	 // Enviar datos al servidor
   	 fetch('procesar_datos.php', {
   		 method: 'POST',
   		 body: JSON.stringify({ estudiantes: datosEstudiantes }),
   		 headers: {
       		 'Content-Type': 'application/json'
   		 }
   	 })
   	 .then(response => response.text())
   	 .then(data => {
   		 console.log(data);
   	 });
    };

    lector.readAsText(archivo);
}











