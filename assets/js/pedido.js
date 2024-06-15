// Constantes para la paginación
const itemsPorPagina = 5; // Define cuántos ítems se mostrarán por página en el carrito
let paginaActual = 1; // Inicializa la página actual para la paginación

// Función para obtener la clave del carrito de un usuario específico
function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID del usuario del DOM
    return `carrito_${userId}`; // Forma la clave para almacenar/recuperar el carrito del usuario en localStorage
}

// Función para verificar disponibilidad de los productos antes de mostrar PayPal
function verificarDisponibilidadAntesDePayPal() {
    const carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey));
    const idsProductos = Object.keys(carrito);

    fetch('../controller/comprobarDisponibilidadController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(idsProductos)
    })
    .then(response => response.json())
    .then(data => {
        const productosNoDisponibles = data.filter(producto => !producto.disponible);
        if (productosNoDisponibles.length > 0) {
            const nombresProductos = productosNoDisponibles.map(p => p.nombre).join(', ');
            showAlert(`Los siguientes productos no están disponibles: ${nombresProductos}`, 'danger');
        } else {
            mostrarBotonPayPal();
        }
    })
    .catch(error => {
        console.error('Error al verificar disponibilidad:', error);
        alert("Error al verificar la disponibilidad de los productos.");
    });
}

// Función para mostrar y configurar el botón de PayPal
function mostrarBotonPayPal() {
    paypal.Buttons({
        style: {
            layout: 'horizontal',
            color: 'gold',
            shape: 'rect',
            label: 'buynow',
            size: 'small'
        },
        createOrder: function(data, actions) { // Función para crear una orden de pago
            var total = document.getElementById('precio-total').textContent.replace(' €', ''); // Obtiene el total del carrito
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total // Asigna el total a pagar
                    }
                }],
                application_context: {
                    shipping_preference: 'NO_SHIPPING' // Configura la orden para no incluir envío
                }
            });
        },
        onApprove: function(data, actions) { // Función que se ejecuta al aprobar el pago
            return actions.order.capture().then(function(details) {
                $('#purchaseConfirmationModal').modal('show'); // Muestra un modal de confirmación
                document.getElementById('userName').textContent = nombreUsuario; // Muestra el nombre del usuario
                enviarDatosCarrito(); // Envía los datos del carrito para procesamiento
                limpiarCarrito(); // Limpia el carrito
            });
        },
        onError: function(err) { // Manejo de errores
            console.error('Error al procesar el pago con PayPal:', err);
        }
    }).render('#paypal-button-container'); // Renderiza el botón de PayPal en el contenedor especificado
}

// Redirecciona cuando el modal de confirmación se oculta
$('#purchaseConfirmationModal').on('hidden.bs.modal', function () {
    window.location.href = "../controller/misPedidosController.php";
});

// Se ejecuta cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    cargarCarrito(); // Carga los productos del carrito
    actualizarContadorCarrito(); // Actualiza el contador de ítems del carrito
    verificarDisponibilidadAntesDePayPal(); // Verifica disponibilidad antes de mostrar PayPal
});

// Función para cargar los productos en el carrito y mostrarlos en la tabla
function cargarCarrito() {
    let carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga los datos del carrito o un objeto vacío si no existe
    const keys = Object.keys(carrito); // Obtiene las claves de los productos en el carrito
    const totalItems = keys.length; // Número total de ítems
    const inicio = (paginaActual - 1) * itemsPorPagina; // Índice de inicio para la paginación
    const fin = inicio + itemsPorPagina; // Índice de fin para la paginación
    const tbody = document.getElementById('carrito-body'); // Obtiene el elemento del cuerpo de la tabla
    tbody.innerHTML = ''; // Limpia el contenido previo
    let total = 0; // Inicializa el total a 0

    // Itera sobre los ítems visibles de la página actual
    keys.slice(inicio, fin).forEach(id => {
        const producto = carrito[id]; // Obtiene cada producto del carrito
        const subtotal = (producto.precio * producto.cantidad).toFixed(2); // Calcula el subtotal
        total += parseFloat(subtotal); // Suma al total

        // Crea y añade una fila por cada producto
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${producto.nombre}</td>
            <td>${producto.precio.toFixed(2)} €</td>
            <td>${producto.cantidad}</td>
            <td>${subtotal} €</td> 
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('precio-total').textContent = total.toFixed(2) + ' €'; // Actualiza el total mostrado
    actualizarPaginacion(totalItems); // Actualiza la paginación según el número total de ítems
}

// Función para actualizar la paginación basada en el total de ítems
function actualizarPaginacion(totalItems) {
    const paginaContainer = document.getElementById('pagination-container'); // Obtiene el contenedor de paginación
    paginaContainer.innerHTML = ''; // Limpia el contenido anterior
    const totalPaginas = Math.ceil(totalItems / itemsPorPagina); // Calcula el total de páginas necesarias

    // Crea y añade botones de paginación
    for (let i = 1; i <= totalPaginas; i++) {
        const button = document.createElement('button');
        button.innerText = i;
        button.className = 'page-item pagination-button';
        if (i === paginaActual) {
            button.classList.add('active');
        }
        button.onclick = function() {
            paginaActual = i;
            cargarCarrito(); // Recarga el carrito para la nueva página seleccionada
        };
        paginaContainer.appendChild(button);
    }
}

// Función para actualizar el contador del carrito
function actualizarContadorCarrito() {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga los datos del carrito
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Calcula el total de productos en el carrito
    const contador = document.getElementById('cart-count'); // Obtiene el contador visual del carrito
    if (contador) {
        contador.textContent = totalItems; // Actualiza el texto del contador
    }
}

// Función para enviar los datos del carrito al servidor
function enviarDatosCarrito() {
    let carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)); // Carga los datos del carrito
    const datosCarrito = Object.values(carrito).map(item => ({
        id_producto_dp: item.id,  // Formatea los datos para el envío
        cantidad: item.cantidad,
        precio: item.precio
    }));

    fetch('../controller/procesarPedidoController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datosCarrito) // Envía los datos como JSON al servidor
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data); // Maneja la respuesta del servidor
    })
    .catch((error) => {
        console.error('Error:', error); // Maneja errores de la petición
    });
}

// Función para limpiar el carrito
function limpiarCarrito() {
    let carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    localStorage.removeItem(carritoKey); // Elimina los datos del carrito de localStorage
    actualizarContadorCarrito(); // Actualiza el contador visual en la interfaz
}

function showAlert(message, type = 'danger') {
    const alertPlaceholder = document.getElementById('alertPlaceholder');
    alertPlaceholder.style.display = 'block';
    alertPlaceholder.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message}
    </div>`;
}
