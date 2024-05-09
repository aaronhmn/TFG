document.addEventListener('DOMContentLoaded', function() {
    cargarCarrito();
});

function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || {};
    const tbody = document.getElementById('carrito-body');
    tbody.innerHTML = '';
    let total = 0;

    Object.entries(carrito).forEach(([id, producto]) => {
        const subtotal = producto.precio * producto.cantidad;
        total += subtotal;

        const row = `
            <tr>
                <td>${producto.nombre}</td>
                <td>${producto.precio.toFixed(2)} €</td>
                <td>${producto.cantidad}</td>
                <td>${subtotal.toFixed(2)} €</td>
            </tr>
        `;
        tbody.innerHTML += row;
    });

    document.getElementById('precio-total').textContent = total.toFixed(2) + ' €';
}

function cambiarCantidad(id, cambio) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    if (carrito[id]) {
        carrito[id].cantidad += cambio;
        if (carrito[id].cantidad <= 0) {
            delete carrito[id];
        }
        localStorage.setItem('carrito', JSON.stringify(carrito));
        cargarCarrito();
    }
}

function eliminarDelCarrito(id) {
    const carrito = JSON.parse(localStorage.getItem('carrito'));
    delete carrito[id];
    localStorage.setItem('carrito', JSON.stringify(carrito));
    cargarCarrito();
}

//*PAYPAL
paypal.Buttons({
    style: {
        layout:  'horizontal', // horizontal | vertical
        color:   'gold',     // gold | blue | silver | black
        shape:   'rect',     // rect | pill
        label:   'buynow',   // checkout | pay | buynow | paypal | credit
        size:    'small'     // small | medium | large | responsive
    },
    createOrder: function(data, actions) {
        var total = document.getElementById('precio-total').textContent;
        total = total.replace(' €', ''); // Asegúrate de que el formato del total es un número decimal como string

        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: total // El total a pagar
                }
            }],
            application_context: {
                shipping_preference: 'NO_SHIPPING' // Si no necesitas dirección de envío
            }
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Pago completado por ' + details.payer.name.given_name + '!');
            // Aquí puedes manejar la lógica post-pago, como guardar la orden en tu base de datos
        });
    },
    onError: function(err) {
        console.error('Error al procesar el pago con PayPal:', err);
    }
}).render('#paypal-button-container');