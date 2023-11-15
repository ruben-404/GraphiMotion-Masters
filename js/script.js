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

function validarFechas() {
    var fechaInicio = new Date(document.getElementById("fecha_inicio").value);
    var fechaFinal = new Date(document.getElementById("fecha_final").value);
    var fechaActual = new Date();

    // Establecer las horas de las fechas a las 00:00:00 para comparar solo las fechas
    fechaInicio.setHours(0, 0, 0, 0);
    fechaFinal.setHours(0, 0, 0, 0);
    fechaActual.setHours(0, 0, 0, 0);

    // Verificar si la fecha de inicio es anterior al día actual
    if (fechaInicio < fechaActual) {
        alert("La fecha de inicio debe ser igual o posterior al día actual.");
        return false;
    }

    // Verificar si la fecha final es anterior a la fecha de inicio
    if (fechaFinal < fechaInicio) {
        alert("La fecha final debe ser igual o posterior a la fecha de inicio.");
        return false;
    }

    return true;
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
		tabla.innerHTML = '';

    	estudiantes.forEach(estudiante => {
        	const datosEstudiante = estudiante.split(',');

        	const fila = tabla.insertRow();
        	for (let i = 0; i < datosEstudiante.length; i++) {
            	const celda = fila.insertCell();
            	celda.textContent = datosEstudiante[i];
        	}
    	});

	};
	document.getElementById("enviarDatos").style.display="block";
	document.getElementById("tablaEstudiantes").style.display="block";
	lector.readAsText(archivo);
}

function enviarDatosEstudiantes() {
    const archivoInput = document.getElementById('archivoInput');
    const archivo = archivoInput.files[0];

    const lector = new FileReader();

    lector.onload = function(e) {
   	 const contenido = e.target.result;
   	 const estudiantes = contenido.split(';');

   	 const datosEstudiantes = estudiantes.map(estudiante => {
   		 const camposSin = estudiante.split(',(');
   		 const campos = camposSin[0].split(','); 
   		 let codigos = camposSin[1] ? camposSin[1].replace(')', '').trim() : ''; // Obtener códigos entre paréntesis sin paréntesis y sin espacios
   		 codigos = codigos ? codigos.split(',').join(',') : ''; // Eliminar espacios y unir códigos con comas

   		 // Devolver el array de campos y códigos sin espacios alrededor
   		 return [...campos.map(campo => campo.trim()), codigos];
   	 });
	 console.log(datosEstudiantes);
   	 // Enviar datos al servidor
	 document.getElementById("enviarDatos").style.display="none";
	 document.getElementById("archivoInput").style.display="none";
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
		 const resultado = document.getElementById('resultado');
		 resultado.innerHTML = data;
   	 });
    };

    lector.readAsText(archivo);
}












