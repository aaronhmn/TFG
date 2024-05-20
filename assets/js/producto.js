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

//*Carrito con localstorage
function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id');
  return `carrito_${userId}`;
}

document.addEventListener('DOMContentLoaded', function() {
  actualizarContadorCarrito();
  const addToCartButton = document.getElementById('add-to-cart');
  if (addToCartButton) {
      addToCartButton.addEventListener('click', function() {
          addProductToCart.call(this);
      });
  }
});

function addProductToCart() {
  const productoId = this.getAttribute('data-id');
  console.log('Producto ID:', productoId);  // Verificar qué se está capturando

  const nombre = this.getAttribute('data-nombre');
  const precio = parseFloat(this.getAttribute('data-precio'));

  let carritoKey = getCarritoKey();
  let carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};

  if (carrito[productoId]) {
      carrito[productoId].cantidad++;
  } else {
      carrito[productoId] = {
          id: productoId,  // Asegúrate que el ID se está añadiendo correctamente
          nombre: nombre,
          precio: precio,
          cantidad: 1
      };
  }

  localStorage.setItem(carritoKey, JSON.stringify(carrito));
  actualizarContadorCarrito();
}

function showAlert(message, type) {
  const alertPlaceholder = document.getElementById('alertPlaceholder');
  const wrapper = document.createElement('div');
  wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
      `${message}`,
      '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
      '</div>'
  ].join('');

  alertPlaceholder.append(wrapper);

  setTimeout(() => {
      wrapper.remove();
  }, 4000); // Las alertas desaparecerán después de 4 segundos
}

function actualizarContadorCarrito() {
  const carritoKey = getCarritoKey();
  const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
  const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
  const contador = document.getElementById('cart-count');
  if (contador) {
      contador.textContent = totalItems;
  }
}