  //*Función para desplazarse suavemente hacia arriba
  function scrollToTop() {
    //*Desplazamiento suave hacia arriba
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  //*Mostrar/ocultar el botón al hacer scroll
  window.onscroll = function() {
    scrollFunction();
  };

  function scrollFunction() {
    const btnSubir = document.getElementById('btnSubir');
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      btnSubir.style.display = 'block';
    } else {
      btnSubir.style.display = 'none';
    }
  }

  //*Transform value
  let value = 0
  //*trail index number
  let trailValue = 0
  //*interval (Duration)
  let interval = 4000

  //*Galeria Producto