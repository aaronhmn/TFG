//*CARRITO
/* document.addEventListener('DOMContentLoaded', function() {
    actualizarContadorCarrito();
  });

  function actualizarContadorCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    const contador = document.getElementById('cart-count');
    if (contador) contador.textContent = totalItems;
  }
 */
  //*BUSCADOR
  $(document).ready(function() {
  $('#formBusqueda').submit(function(event) {
      event.preventDefault();
      var query = $('#busqueda').val();
      if (query.length > 2) {
          $.ajax({
              url: "../controller/tiendaController.php",
              type: "GET",
              data: {
                  busqueda: query
              },
              dataType: 'html',
              success: function(data) {
                  if (data.includes('<!-- NO_RESULTS -->')) {
                      // Muestra la alerta, sin borrar los productos existentes
                      $('#alertContainer').html('<div class="alert alert-warning" role="alert">No se encontraron productos que coincidan con su búsqueda.</div>');
                  } else {
                      // Actualiza el contenedor con los nuevos productos
                      $('#productosContainer').html(data);
                      $('#alertContainer').empty(); // Limpia cualquier alerta previa
                  }
              },
              error: function() {
                  $('#productosContainer').html('<p>Error al procesar la búsqueda.</p>');
              }
          });
      } else {
          $('#productosContainer').html('<p>Introduce al menos 3 caracteres para buscar.</p>');
      }
  });
});