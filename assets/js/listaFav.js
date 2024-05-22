// Constantes para la paginación
const itemsPorPagina = 5;
let paginaActual = 1;

function getFavoritosKey() {
    const userId = document.body.getAttribute('data-user-id');
    return `favoritos_${userId}`;
}

// Cargar los productos favoritos desde localStorage y actualizar la vista
function cargarFavoritos() {
    let favoritosKey = getFavoritosKey();
    const favoritos = JSON.parse(localStorage.getItem(favoritosKey)) || {};
    const keys = Object.keys(favoritos);
    const totalItems = keys.length;
    const inicio = (paginaActual - 1) * itemsPorPagina;
    const fin = Math.min(inicio + itemsPorPagina, totalItems); // Asegurarse de no exceder el número de ítems

    const tbody = document.getElementById('carrito-body');
    tbody.innerHTML = '';

    keys.slice(inicio, fin).forEach(id => { // Usar slice para mostrar solo los ítems de la página actual
        const producto = favoritos[id];
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.nombre}" style="width: 90px; height: auto; vertical-align: middle; margin-right: 10px;"></td>
            <td><a href="../controller/productoController.php?id=${producto.id}">${producto.nombre}</a></td>
            <td>${producto.precio ? `${producto.precio} €` : 'Precio no disponible'}</td>
            <td>
                <button onclick="eliminarDeFavoritos('${id}')" class="btn btn-eliminar"><i class="fa fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
    });

    actualizarPaginacionFavoritos(totalItems);
}

// Actualiza la paginación en función del total de ítems en los favoritos
function actualizarPaginacionFavoritos(totalItems) {
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
            cargarFavoritos(); // Recargar la vista con los nuevos ítems de la página seleccionada
        };
        paginaContainer.appendChild(button);
    }
}

// Elimina un producto de los favoritos
function eliminarDeFavoritos(id) {
    const favoritosKey = getFavoritosKey();
    const favoritos = JSON.parse(localStorage.getItem(favoritosKey));
    if (favoritos && favoritos.hasOwnProperty(id)) {
        delete favoritos[id];
        localStorage.setItem(favoritosKey, JSON.stringify(favoritos));
        cargarFavoritos();
    }
}

// Asegurarse de que se carga la lista de favoritos al cargar la página
window.onload = function() {
    cargarFavoritos();  // Esto reemplaza cualquier otro window.onload que pueda haber sido definido
};

//*CARRITO
document.addEventListener('DOMContentLoaded', function() {
    actualizarContadorCarrito();
  });
  
  function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id');
    return `carrito_${userId}`;
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