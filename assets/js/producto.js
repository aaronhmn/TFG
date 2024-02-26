  //*Función para desplazarse suavemente hacia arriba
  function scrollToTop() {
    //?Desplazamiento suave hacia arriba
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  //?Mostrar/ocultar el botón al hacer scroll
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

  //?Transform value
  let value = 0
  //?trail index number
  let trailValue = 0
  //?interval (Duration)
  let interval = 4000


  //*Galeria Producto
  //?recogo la id de la imagen grande
  let mainImg = document.getElementById('mainImg');

  //?recogo las imagenes pequeñas mediante sus clases de css
  let smallImg = document.getElementsByClassName('small-img');

  //?Para cambiar la imagen grande por la imagen pequeña a la que haga le click
  smallImg[0].onclick = function(){
    mainImg.src = smallImg[0].src;
  }

  smallImg[1].onclick = function(){
    mainImg.src = smallImg[1].src;
  }

  smallImg[2].onclick = function(){
    mainImg.src = smallImg[2].src;
  }

  smallImg[3].onclick = function(){
    mainImg.src = smallImg[3].src;
  }

 //*Dar borde a la imagen seleccionada para informacion de que imagen esta seleccionando para ampliarla
 //?Obtener todos los elementos con la clase 'small-img-col'
  const smallImgCols = document.querySelectorAll('.small-img-col');

  //?Iterar sobre cada elemento y agregar un evento de click
  smallImgCols.forEach(col => {
    col.addEventListener('click', () => {
      
      //?Eliminar la clase 'selected' de todos los elementos
      smallImgCols.forEach(col => col.classList.remove('selected'));

      //?Agregar la clase 'selected' solo al elemento clicado
      col.classList.add('selected');
    });
  });