// Constantes para la paginación
const itemsPorPagina = 10;
let paginaActual = 1;

// Carga los productos del carrito desde localStorage y actualiza la vista
function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
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
    const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
    const totalItems = Object.values(carrito).reduce((acc, {cantidad}) => acc + cantidad, 0);
    const contador = document.getElementById('cart-count');
    if (contador) {
        contador.textContent = totalItems;
    }
}

// Cambia la cantidad de un producto específico
function cambiarCantidad(id, cambio) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    if (carrito && carrito[id]) {
        carrito[id].cantidad += cambio;
        if (carrito[id].cantidad < 1) {
            delete carrito[id];
        } else {
            localStorage.setItem('carrito', JSON.stringify(carrito));
        }
        cargarCarrito();
    }
}

// Elimina un producto del carrito
function eliminarDelCarrito(id) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    if (carrito && carrito.hasOwnProperty(id)) {
        delete carrito[id];
        localStorage.setItem('carrito', JSON.stringify(carrito));
        cargarCarrito();
    }
}

// Cargar el carrito al cargar la página
window.onload = cargarCarrito;
