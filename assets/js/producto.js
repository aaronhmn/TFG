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

//*CARRITO CON lOCAL STORAGE
function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id');
  return `carrito_${userId}`;
}

document.addEventListener('DOMContentLoaded', function() {
  const addToCartButton = document.getElementById('add-to-cart');
  if (addToCartButton) {
      addToCartButton.addEventListener('click', function() {
          const stock = parseInt(this.getAttribute('data-stock'));
          if (stock > 0) {
              addProductToCart.call(this);
          } else {
              showAlert('Este producto no tiene stock disponible.', 'warning');
          }
      });
  }
  actualizarContadorCarrito();
});

function addProductToCart() {
  const productoId = this.getAttribute('data-id');
  const nombre = this.getAttribute('data-nombre');
  const precio = parseFloat(this.getAttribute('data-precio'));
  const stock = parseInt(this.getAttribute('data-stock'));

  let carritoKey = getCarritoKey();
  let carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};

  if (carrito[productoId]) {
      if (carrito[productoId].cantidad < stock) {
          carrito[productoId].cantidad++;
      } else {
          showAlert('No puedes añadir más unidades de este producto. Stock máximo alcanzado.', 'warning');
          return;
      }
  } else {
      carrito[productoId] = {
          id: productoId,
          nombre: nombre,
          precio: precio,
          cantidad: 1,
          stock: stock // Asegúrate de añadir esta línea
      };
  }

  localStorage.setItem(carritoKey, JSON.stringify(carrito));
  actualizarContadorCarrito();
  showAlert('Producto añadido al carrito', 'success');
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

  // Asegúrate de que la alerta se muestre en la pantalla visible
  alertPlaceholder.scrollIntoView({ behavior: 'smooth', block: 'center' });

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

//*LISTA DE FAVORITOS CON LOCAL STORAGE

function getFavoritosKey() {
  const userId = document.body.getAttribute('data-user-id');
  return `favoritos_${userId}`;
}

document.addEventListener('DOMContentLoaded', function() {
  const addToFavButton = document.getElementById('add-to-fav');
  if (addToFavButton) {
      addToFavButton.addEventListener('click', function() {
          addProductToFavorites.call(this);
      });
  }
});

function addProductToFavorites() {
  const productoId = this.getAttribute('data-id');
  const nombre = this.getAttribute('data-nombre');
  const precio = parseFloat(this.getAttribute('data-precio'));
  const imagen = this.getAttribute('data-imagen'); // Recuperar la imagen desde el botón

  let favoritosKey = getFavoritosKey();
  let favoritos = JSON.parse(localStorage.getItem(favoritosKey)) || {};

  if (!favoritos[productoId]) {
      favoritos[productoId] = {
          id: productoId,
          nombre: nombre,
          precio: precio,
          imagen: imagen // Guardar la imagen
      };
      localStorage.setItem(favoritosKey, JSON.stringify(favoritos));
      showAlert('Producto añadido a favoritos', 'success');
  } else {
      showAlert('Este producto ya está en favoritos', 'warning');
  }
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
  }, 4000);
}