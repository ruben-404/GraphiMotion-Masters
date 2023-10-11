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

