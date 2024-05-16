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
            layout:  'horizontal', // horizontal | vertical
            color:   'gold',       // gold | blue | silver | black
            shape:   'rect',       // rect | pill
            label:   'buynow',     // checkout | pay | buynow | paypal | credit
            size:    'small'       // small | medium | large | responsive
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
                    shipping_preference: 'NO_SHIPPING' // Sin dirección de envío
                }
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Pago completado por ' + details.payer.name.given_name + '!');
                // Aquí puedes agregar lógica para manejar la transacción completada
            });
        },
        onError: function(err) {
            console.error('Error al procesar el pago con PayPal:', err);
        }
    }).render('#paypal-button-container');
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