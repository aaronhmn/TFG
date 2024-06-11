//*Función para desplazarse suavemente hacia arriba
function scrollToTop() {
  //?Desplazamiento suave hacia arriba
  window.scrollTo({
    top: 0, // Establece la posición de desplazamiento vertical a 0 (inicio de la página)
    behavior: 'smooth' // Establece el tipo de desplazamiento a "suave"
  });
}

//?Mostrar/ocultar el botón al hacer scroll
window.onscroll = function() {
  scrollFunction(); // Llama a scrollFunction() cada vez que el usuario hace scroll
};

function scrollFunction() {
  const btnSubir = document.getElementById('btnSubir'); // Obtiene el botón para subir
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btnSubir.style.display = 'block'; // Muestra el botón si el scroll es mayor a 20px
  } else {
    btnSubir.style.display = 'none'; // Oculta el botón si el scroll es menor a 20px
  }
}

//*Galeria Producto
//?recojo la id de la imagen grande
let mainImg = document.getElementById('mainImg'); // Obtiene la imagen principal

//?recojo las imagenes pequeñas mediante sus clases de css
let smallImg = document.getElementsByClassName('small-img'); // Obtiene todas las imágenes pequeñas

//?Para cambiar la imagen grande por la imagen pequeña a la que haga le click
smallImg[0].onclick = function(){
  mainImg.src = smallImg[0].src; // Cambia la imagen grande a la imagen pequeña 0 al hacer clic
};

smallImg[1].onclick = function(){
  mainImg.src = smallImg[1].src; // Cambia la imagen grande a la imagen pequeña 1 al hacer clic
};

smallImg[2].onclick = function(){
  mainImg.src = smallImg[2].src; // Cambia la imagen grande a la imagen pequeña 2 al hacer clic
};

smallImg[3].onclick = function(){
  mainImg.src = smallImg[3].src; // Cambia la imagen grande a la imagen pequeña 3 al hacer clic
};

//*Dar borde a la imagen seleccionada para informacion de que imagen esta seleccionando para ampliarla
//?Obtener todos los elementos con la clase 'small-img-col'
const smallImgCols = document.querySelectorAll('.small-img-col'); // Obtiene todos los contenedores de las imágenes pequeñas

//?Iterar sobre cada elemento y agregar un evento de click
smallImgCols.forEach(col => {
  col.addEventListener('click', () => {
    
    //?Eliminar la clase 'selected' de todos los elementos
    smallImgCols.forEach(col => col.classList.remove('selected')); // Elimina la clase 'selected' de todos los contenedores

    //?Agregar la clase 'selected' solo al elemento clicado
    col.classList.add('selected'); // Agrega la clase 'selected' al contenedor clicado
  });
});

//*CARRITO CON LOCAL STORAGE
function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID de usuario del atributo del body
  return `carrito_${userId}`; // Devuelve la clave del carrito para el usuario específico
}

document.addEventListener('DOMContentLoaded', function() {
  const addToCartButton = document.getElementById('add-to-cart'); // Obtiene el botón de añadir al carrito
  if (addToCartButton) {
      addToCartButton.addEventListener('click', function() {
          const stock = parseInt(this.getAttribute('data-stock')); // Obtiene el stock del producto desde el atributo
          if (stock > 0) {
              addProductToCart.call(this); // Llama a addProductToCart si hay stock
          } else {
              showAlert('Este producto no tiene stock disponible.', 'warning'); // Muestra una alerta si no hay stock
          }
      });
  }
  actualizarContadorCarrito(); // Actualiza el contador del carrito al cargar la página
});

function addProductToCart() {
  const productoId = this.getAttribute('data-id'); // Obtiene el ID del producto desde el atributo
  const nombre = this.getAttribute('data-nombre'); // Obtiene el nombre del producto
  const precio = parseFloat(this.getAttribute('data-precio')); // Obtiene el precio del producto
  const stock = parseInt(this.getAttribute('data-stock')); // Obtiene el stock del producto

  let carritoKey = getCarritoKey(); // Obtiene la clave del carrito
  let carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Obtiene el carrito del almacenamiento local o crea uno nuevo

  if (carrito[productoId]) {
      if (carrito[productoId].cantidad < stock) {
          carrito[productoId].cantidad++; // Incrementa la cantidad si no se ha alcanzado el stock máximo
      } else {
          showAlert('No puedes añadir más unidades de este producto. Stock máximo alcanzado.', 'warning'); // Muestra una alerta si se alcanza el stock máximo
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

  localStorage.setItem(carritoKey, JSON.stringify(carrito)); // Guarda el carrito en el almacenamiento local
  actualizarContadorCarrito(); // Actualiza el contador del carrito
  showAlert('Producto añadido al carrito', 'success'); // Muestra una alerta de éxito
}

function showAlert(message, type) {
  const alertPlaceholder = document.getElementById('alertPlaceholder'); // Obtiene el contenedor de alertas
  const wrapper = document.createElement('div'); // Crea un nuevo elemento div
  wrapper.innerHTML = [
      `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`, // Configura el HTML de la alerta
      `${message}`, // Inserta el mensaje de la alerta
      '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', // Añade un botón para cerrar la alerta
      '</div>'
  ].join('');

  alertPlaceholder.append(wrapper); // Añade la alerta al contenedor

  // Asegúrate de que la alerta se muestre en la pantalla visible
  alertPlaceholder.scrollIntoView({ behavior: 'smooth', block: 'center' });

  setTimeout(() => {
      wrapper.remove(); // Elimina la alerta después de 4 segundos
  }, 4000);
}

function actualizarContadorCarrito() {
  const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
  const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Obtiene el carrito del almacenamiento local
  const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Calcula el total de productos en el carrito
  const contador = document.getElementById('cart-count'); // Obtiene el contador del carrito
  if (contador) {
      contador.textContent = totalItems; // Actualiza el texto del contador
  }
}

//*LISTA DE FAVORITOS CON LOCAL STORAGE

function getFavoritosKey() {
  const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID de usuario del atributo del body
  return `favoritos_${userId}`; // Devuelve la clave de favoritos para el usuario específico
}

document.addEventListener('DOMContentLoaded', function() {
  const addToFavButton = document.getElementById('add-to-fav'); // Obtiene el botón de añadir a favoritos
  if (addToFavButton) {
      addToFavButton.addEventListener('click', function() {
          addProductToFavorites.call(this); // Llama a addProductToFavorites al hacer clic
      });
  }
});

function addProductToFavorites() {
  const productoId = this.getAttribute('data-id'); // Obtiene el ID del producto desde el atributo
  const nombre = this.getAttribute('data-nombre'); // Obtiene el nombre del producto desde el atributo
  const precio = parseFloat(this.getAttribute('data-precio')); // Obtiene el precio del producto y lo convierte a número
  const imagen = this.getAttribute('data-imagen'); // Recupera la imagen del producto desde el atributo

  let favoritosKey = getFavoritosKey(); // Obtiene la clave para almacenar los favoritos en localStorage
  let favoritos = JSON.parse(localStorage.getItem(favoritosKey)) || {}; // Recupera los favoritos desde localStorage o inicializa un objeto vacío si no hay datos

  if (!favoritos[productoId]) { // Verifica si el producto ya está en favoritos
      favoritos[productoId] = {
          id: productoId, // Guarda el ID del producto
          nombre: nombre, // Guarda el nombre del producto
          precio: precio, // Guarda el precio del producto
          imagen: imagen // Guarda la imagen del producto
      };
      localStorage.setItem(favoritosKey, JSON.stringify(favoritos)); // Almacena los favoritos actualizados en localStorage
      showAlert('Producto añadido a favoritos', 'success'); // Muestra un mensaje de éxito
  } else {
      showAlert('Este producto ya está en favoritos', 'warning'); // Muestra un mensaje de advertencia si el producto ya está en favoritos
  }
}

function showAlert(message, type) {
  const alertPlaceholder = document.getElementById('alertPlaceholder'); // Obtiene el elemento donde se mostrarán las alertas
  const wrapper = document.createElement('div'); // Crea un nuevo div para la alerta
  wrapper.innerHTML = [ // Define el contenido HTML de la alerta
      `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`, // Incluye el tipo de alerta para estilización
      `${message}`, // Inserta el mensaje de la alerta
      '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>', // Agrega un botón para cerrar la alerta
      '</div>'
  ].join('');

  alertPlaceholder.append(wrapper); // Añade la alerta al placeholder

  setTimeout(() => {
      wrapper.remove(); // Elimina la alerta después de 4 segundos
  }, 4000);
}