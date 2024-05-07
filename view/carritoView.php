<?php

namespace views;
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="../assets/styles/css/carrito.css" />
  <link rel="icon" type="image/vnd.icon" href="../assets/img/genesis logo sin fondo favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />

  <title>Página de Contacto - Genesis</title>
</head>

<body style="background-color: #e6e6fa">
  <!--NAV DE LA PAGINA-->
  <?php include '../controller/navbarController.php'; ?>

  <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Producto</th>
          <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Precio Subtotal</th>
          <th style="text-align:center;" scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
    <div>Precio Total: <span id="precio-total">0 €</span></div>
  </div><br>

  <!--FOOTER-->
  <?php include '../controller/footerController.php'; ?>

  <script>
window.onload = function() {
  cargarCarrito();
}

function cargarCarrito() {
  const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
  const tbody = document.querySelector('tbody');
  tbody.innerHTML = ''; // Limpia la tabla antes de rellenarla
  let total = 0;

  Object.keys(carrito).forEach(id => {
    const producto = carrito[id];
    const subtotal = (producto.precio * producto.cantidad).toFixed(2);
    total += parseFloat(subtotal); // Suma al total

    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${producto.nombre}</td>
                    <td>${producto.precio} €</td>
                    <td>
                      <button class="cantidad" onclick="cambiarCantidad('${id}', -1)">-</button>
                      ${producto.cantidad}
                      <button class="cantidad" onclick="cambiarCantidad('${id}', 1)">+</button>
                    </td>
                    <td>${subtotal} €</td>
                    <td style="text-align:center;"><button onclick="eliminarDelCarrito('${id}')" class="btn btn-eliminar"><i class="fa fa-trash"></i></button></td>`;
    tbody.appendChild(tr);
  });

  document.getElementById('precio-total').textContent = `${total.toFixed(2)} €`; // Actualiza el precio total
}

function cambiarCantidad(id, cambio) {
  const carrito = JSON.parse(localStorage.getItem('carrito'));
  if (carrito[id]) {
    carrito[id].cantidad += cambio;
    if (carrito[id].cantidad < 1) {
      delete carrito[id]; // Elimina el producto si la cantidad es menor a 1
    } else {
      localStorage.setItem('carrito', JSON.stringify(carrito));
    }
    cargarCarrito(); // Recarga el carrito para reflejar los cambios
  }
}

function eliminarDelCarrito(id) {
  const carrito = JSON.parse(localStorage.getItem('carrito'));
  delete carrito[id];
  localStorage.setItem('carrito', JSON.stringify(carrito));
  cargarCarrito(); // Recarga la página para actualizar la tabla
}
</script>
</body>

</html>