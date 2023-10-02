function PremiosBuenos() {
    var frases = ['Frase 1', 'Frase 2', 'Frase 3']; // Tu array de frases
    var randomIndex = Math.floor(Math.random() * frases.length);
    var fraseAleatoria = frases[randomIndex];
    alert(fraseAleatoria);
  }