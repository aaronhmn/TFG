// Constantes para la paginación
const itemsPorPagina = 5; // Número de items por página en la paginación
let paginaActual = 1; // Página inicial en la paginación

// Función para obtener la clave de localStorage para el carrito de un usuario específico
function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID del usuario del atributo del body
    return `carrito_${userId}`; // Retorna la clave del carrito específica para el usuario
}

// Función para cargar los productos del carrito desde localStorage y actualizar la interfaz
function cargarCarrito() {
    let carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga el carrito de localStorage o usa un objeto vacío si no existe
    const keys = Object.keys(carrito); // Obtiene las claves de los productos en el carrito
    const totalItems = keys.length; // Total de productos en el carrito
    const inicio = (paginaActual - 1) * itemsPorPagina; // Calcula el índice de inicio para la paginación
    const fin = inicio + itemsPorPagina; // Calcula el índice de fin para la paginación
    const tieneProductos = keys.length > 0; // Booleano que indica si hay productos en el carrito
    const botonPedido = document.getElementById('realizarPedidoBtn'); // Obtiene el botón para realizar pedidos

    botonPedido.style.display = tieneProductos ? 'block' : 'none'; // Muestra u oculta el botón de pedido basado en si hay productos

    const tbody = document.getElementById('carrito-body'); // Obtiene el tbody del carrito para insertar filas de productos
    tbody.innerHTML = ''; // Limpia el contenido anterior del tbody
    let total = 0; // Inicializa el total a 0

    // Itera sobre los productos visibles en la página actual
    keys.slice(inicio, fin).forEach(id => {
        const producto = carrito[id]; // Obtiene el producto actual
        const subtotal = (producto.precio * producto.cantidad).toFixed(2); // Calcula el subtotal del producto
        total += parseFloat(subtotal); // Suma al total general

        // Crea una fila de tabla y la llena con información del producto
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
        tbody.appendChild(tr); // Agrega la fila al tbody
    });

    // Muestra el total en el documento
    document.getElementById('precio-total').textContent = `${total.toFixed(2)} €`;
    actualizarPaginacion(totalItems); // Actualiza los controles de paginación
    actualizarContadorCarrito(); // Actualiza el contador de ítems en el ícono del carrito
}

// Función para actualizar la paginación basada en el total de ítems
function actualizarPaginacion(totalItems) {
    const paginaContainer = document.getElementById('pagination-container'); // Obtiene el contenedor de la paginación
    paginaContainer.innerHTML = ''; // Limpia el contenedor de paginación
    const totalPaginas = Math.ceil(totalItems / itemsPorPagina); // Calcula el total de páginas

    // Crea botones de paginación
    for (let i = 1; i <= totalPaginas; i++) {
        const button = document.createElement('button');
        button.innerText = i; // Establece el número de página en el botón
        button.className = 'page-item pagination-button'; // Clases para el botón
        if (i === paginaActual) {
            button.classList.add('active'); // Destaca el botón de la página actual
        }
        button.onclick = function() { // Define la acción al hacer clic
            paginaActual = i; // Establece la página actual a la página clicada
            cargarCarrito(); // Recarga el carrito para la nueva página
        };
        paginaContainer.appendChild(button); // Agrega el botón al contenedor de paginación
    }
}

// Función para actualizar el contador de productos en el carrito
function actualizarContadorCarrito() {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga el carrito de localStorage
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Suma las cantidades de todos los productos
    const contador = document.getElementById('cart-count'); // Obtiene el elemento del contador
    if (contador) {
        contador.textContent = totalItems; // Actualiza el contador en el documento
    }
}

// Función para cambiar la cantidad de un producto específico en el carrito
function cambiarCantidad(id, cambio) {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)); // Carga el carrito

    if (carrito && carrito[id]) {
        const nuevaCantidad = carrito[id].cantidad + cambio; // Calcula la nueva cantidad

        // Verifica y maneja los límites de la cantidad del producto
        if (nuevaCantidad > carrito[id].stock) {
            showAlert('No puedes añadir más unidades de este producto. Stock máximo alcanzado.', 'warning');
            return; // Detiene la función si se excede el stock
        }

        if (nuevaCantidad < 1) {
            showAlert('No puedes reducir la cantidad a menos de uno.', 'warning');
            return; // Detiene la función si la cantidad es menos de uno
        }

        // Actualiza la cantidad en el carrito
        carrito[id].cantidad = nuevaCantidad;
        localStorage.setItem(carritoKey, JSON.stringify(carrito)); // Guarda el carrito actualizado en localStorage
        cargarCarrito(); // Recarga el carrito
        actualizarContadorCarrito(); // Actualiza el contador de productos
    }
}

// Función para eliminar un producto del carrito
function eliminarDelCarrito(id) {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)); // Carga el carrito
    if (carrito && carrito.hasOwnProperty(id)) {
        delete carrito[id]; // Elimina el producto del carrito
        localStorage.setItem(carritoKey, JSON.stringify(carrito)); // Guarda el carrito actualizado en localStorage
        cargarCarrito(); // Recarga el carrito
    }
}

// Función asíncrona para verificar la disponibilidad de los productos y proceder con el pedido
async function verificarDisponibilidadYRealizarPedido() {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)); // Carga el carrito
    const ids = Object.keys(carrito); // Obtiene los IDs de los productos en el carrito

    try {
        const response = await fetch('../controller/comprobarDisponibilidadController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(ids) // Envía los IDs como JSON al servidor
        });
        const productos = await response.json(); // Espera y procesa la respuesta como JSON

        const productosNoDisponibles = productos.filter(p => !p.disponible); // Filtra los productos no disponibles

        if (productosNoDisponibles.length > 0) {
            // Si hay productos no disponibles, muestra una alerta
            const nombresNoDisponibles = productosNoDisponibles.map(p => p.nombre).join(', ');
            showAlert(`Los siguientes productos no están disponibles y no pueden ser pedidos: ${nombresNoDisponibles}`, 'warning');
            return; // Detiene la función si hay productos no disponibles
        }

        // Si todos los productos están disponibles, procede con el pedido
        realizarPedido();
    } catch (error) {
        console.error('Error al verificar la disponibilidad de los productos:', error);
    }
}

// Función para realizar el pedido
function realizarPedido() {
    console.log("Todos los productos están disponibles. Procediendo con el pedido.");
    window.location.href = '../controller/pedidoController.php'; // Redirige al usuario para completar el pedido
}

// Función para mostrar alertas en la interfaz
function showAlert(message, type) {
    const alertPlaceholder = document.getElementById('alertPlaceholder'); // Obtiene el contenedor de alertas
    const wrapper = document.createElement('div'); // Crea un contenedor para la alerta
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
        `${message}`,
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');

    alertPlaceholder.append(wrapper); // Añade la alerta al contenedor

    setTimeout(() => {
        wrapper.remove(); // Elimina la alerta después de 4 segundos
    }, 4000);
}

// Cargar el carrito al cargar la página
window.onload = cargarCarrito;
