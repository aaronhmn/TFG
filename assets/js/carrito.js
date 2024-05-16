// Constantes para la paginación
const itemsPorPagina = 10;
let paginaActual = 1;

function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id');
    return `carrito_${userId}`;
  }
// Carga los productos del carrito desde localStorage y actualiza la vista
function cargarCarrito() {
    let carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
    const keys = Object.keys(carrito);
    const totalItems = keys.length;
    const inicio = (paginaActual - 1) * itemsPorPagina;
    const fin = inicio + itemsPorPagina;
    const tieneProductos = keys.length > 0;
    const botonPedido = document.getElementById('realizarPedidoBtn');

    botonPedido.style.display = tieneProductos ? 'block' : 'none';

    const tbody = document.getElementById('carrito-body');
    tbody.innerHTML = '';
    let total = 0;

    keys.slice(inicio, fin).forEach(id => {
        const producto = carrito[id];
        const subtotal = (producto.precio * producto.cantidad).toFixed(2);
        total += parseFloat(subtotal);

        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${producto.nombre}</td>
            <td>${producto.precio} €</td>
            <td>
                <button class="cantidad" onclick="cambiarCantidad('${id}', -1)">-</button>
                ${producto.cantidad}
                <button class="cantidad" onclick="cambiarCantidad('${id}', 1)">+</button>
            </td>
            <td>${subtotal} €</td>
            <td><button onclick="eliminarDelCarrito('${id}')" class="btn btn-eliminar"><i class="fa fa-trash"></i></button></td>
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('precio-total').textContent = `${total.toFixed(2)} €`;
    actualizarPaginacion(totalItems);
    actualizarContadorCarrito();
}

// Actualiza la paginación en función del total de ítems en el carrito
function actualizarPaginacion(totalItems) {
    const paginaContainer = document.getElementById('pagination-container');
    paginaContainer.innerHTML = '';
    const totalPaginas = Math.ceil(totalItems / itemsPorPagina);

    for (let i = 1; i <= totalPaginas; i++) {
        const button = document.createElement('button');
        button.innerText = i;
        button.className = 'page-item pagination-button';
        if (i === paginaActual) {
            button.classList.add('active');
        }
        button.onclick = function() {
            paginaActual = i;
            cargarCarrito();
        };
        paginaContainer.appendChild(button);
    }
}

// Actualiza el contador de ítems en el icono del carrito
function actualizarContadorCarrito() {
    const carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    const contador = document.getElementById('cart-count');
    if (contador) {
        contador.textContent = totalItems;
    }
}

// Cambia la cantidad de un producto específico
function cambiarCantidad(id, cambio) {
    const carritoKey = getCarritoKey();  // Usar la clave correcta del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey));
    if (carrito && carrito[id]) {
        carrito[id].cantidad += cambio;
        // Asegurarse de que la cantidad no sea menor que 1
        if (carrito[id].cantidad < 1) {
            carrito[id].cantidad = 1;  // Establecer la cantidad mínima como 1
        }
        localStorage.setItem(carritoKey, JSON.stringify(carrito));  // Guardar usando la clave correcta
        cargarCarrito();
        actualizarContadorCarrito();  // Asegúrate de actualizar el contador del carrito también si es necesario
    }
}

// Elimina un producto del carrito
function eliminarDelCarrito(id) {
    const carritoKey = getCarritoKey();  // Usar la clave correcta del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey));
    if (carrito && carrito.hasOwnProperty(id)) {
        delete carrito[id];
        localStorage.setItem(carritoKey, JSON.stringify(carrito));  // Guardar usando la clave correcta
        cargarCarrito();
    }
}

// Cargar el carrito al cargar la página
window.onload = cargarCarrito;
