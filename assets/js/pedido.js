// Constantes para la paginación
const itemsPorPagina = 5;
let paginaActual = 1;

function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id');
    return `carrito_${userId}`;
  }

document.addEventListener('DOMContentLoaded', function() {
    cargarCarrito();
    actualizarContadorCarrito();
    // Asegura que el botón de PayPal se renderice correctamente
    paypal.Buttons({
        style: {
            layout:  'horizontal',
            color:   'gold',
            shape:   'rect',
            label:   'buynow',
            size:    'small'
        },
        createOrder: function(data, actions) {
            var total = document.getElementById('precio-total').textContent.replace(' €', '');
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total // El total a pagar
                    }
                }],
                application_context: {
                    shipping_preference: 'NO_SHIPPING'
                }
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Mostrar el modal con el nombre del usuario
                $('#purchaseConfirmationModal').modal('show');
                document.getElementById('userName').textContent = nombreUsuario; // Usar la variable global
    
                // Envía los datos del carrito al servidor
                enviarDatosCarrito();
                // Limpiar el carrito
                limpiarCarrito();
            });
        },
        onError: function(err) {
            console.error('Error al procesar el pago con PayPal:', err);
        }
    }).render('#paypal-button-container');
    $('#purchaseConfirmationModal').on('hidden.bs.modal', function () {
        window.location.href = "../controller/misPedidosController.php";
    });
});

function cargarCarrito() {
    let carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
    const keys = Object.keys(carrito);
    const totalItems = keys.length;
    const inicio = (paginaActual - 1) * itemsPorPagina;
    const fin = inicio + itemsPorPagina;
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
                <td>${producto.precio.toFixed(2)} €</td>
                <td>${producto.cantidad}</td>
                <td>${subtotal} €</td> 
        `;
        tbody.appendChild(tr);
    });

    document.getElementById('precio-total').textContent = total.toFixed(2) + ' €';
    actualizarPaginacion(totalItems);
}

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

function actualizarContadorCarrito() {
    const carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {};
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    const contador = document.getElementById('cart-count');
    if (contador) {
        contador.textContent = totalItems;
    }
}

function enviarDatosCarrito() {
    let carritoKey = getCarritoKey();
    const carrito = JSON.parse(localStorage.getItem(carritoKey));
    const datosCarrito = Object.values(carrito).map(item => ({
        id_producto_dp: item.id,  // Asegúrate de que esta clave sea la correcta
        cantidad: item.cantidad,
        precio: item.precio
    }));

    fetch('../controller/procesarPedidoController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datosCarrito)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // Aquí puedes gestionar el redireccionamiento o la confirmación visual
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function limpiarCarrito() {
    let carritoKey = getCarritoKey();
    localStorage.removeItem(carritoKey);
    actualizarContadorCarrito(); // Actualizar el contador visual en la interfaz
}