function PremiosBuenos() {
    var premios = ["Premio 1", "Premio 2", "Premio 3"];
    var indiceAleatorio = Math.floor(Math.random() * premios.length);
    var premioGanado = premios[indiceAleatorio];
    
    // Construir el contenido de la ventana emergente
    var mensaje = "¡HAS GANADO " + premioGanado + "!";
    var ventanaEmergente = window.open("premio.html", "ventanaEmergente", "width=400,height=200,top=50%,left=50%,scrollbars=no");
    
    // Agregar contenido HTML a la ventana emergente
    var contenidoHTML = `
        <html>
        <head>
            <title>Ventana Emergente</title>
        </head>
        <body>
            <h1>${mensaje}</h1>
            <button onclick="window.close()">Cerrar</button>
        </body>
        </html>
    `;
    
    ventanaEmergente.document.write(contenidoHTML);
    
  }