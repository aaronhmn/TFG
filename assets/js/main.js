// Función para desplazarse suavemente hacia arriba
function scrollToTop() {
  //* Desplazamiento suave hacia arriba
  window.scrollTo({
    top: 0, // Define el punto de desplazamiento vertical al inicio de la página (arriba del todo)
    behavior: "smooth", // Establece el comportamiento del desplazamiento como suave
  });
}

// Mostrar/ocultar el botón al hacer scroll
window.onscroll = function () {
  scrollFunction(); // Llama a la función scrollFunction cuando el usuario hace scroll en la página
};

function scrollFunction() {
  const btnSubir = document.getElementById("btnSubir"); // Obtiene el botón para subir por su ID
  // Verifica la posición del scroll en el cuerpo del documento o en el elemento raíz (html)
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btnSubir.style.display = "block"; // Muestra el botón si el scroll es mayor a 20px
  } else {
    btnSubir.style.display = "none"; // Oculta el botón si el scroll es menor o igual a 20px
  }
}

//*CARRITO
document.addEventListener('DOMContentLoaded', function() {
  actualizarContadorCarrito(); // Llama a la función actualizarContadorCarrito cuando el documento ha terminado de cargar
});

function getCarritoKey() {
  const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID del usuario desde un atributo en el cuerpo del documento
  return `carrito_${userId}`; // Devuelve la clave específica para el carrito de ese usuario en localStorage
}

function actualizarContadorCarrito() {
  const carritoKey = getCarritoKey(); // Obtiene la clave del carrito de compras del usuario
  const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga el carrito desde localStorage o inicia con un objeto vacío si no existe
  const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Calcula la suma total de productos en el carrito
  const contador = document.getElementById('cart-count'); // Obtiene el elemento que muestra el contador de productos en el carrito
  if (contador) {
      contador.textContent = totalItems; // Actualiza el contenido del contador con el total de productos
  }
}
