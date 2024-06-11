// Constantes para la paginación
const itemsPorPagina = 5; // Número de ítems por página en las listas
let paginaActual = 1; // Página actual inicialmente configurada en 1

// Función para obtener la clave del almacenamiento local para los favoritos de un usuario específico
function getFavoritosKey() {
    const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID del usuario desde un atributo en el cuerpo del documento
    return `favoritos_${userId}`; // Retorna la clave para los favoritos en localStorage
}

// Función para cargar los productos favoritos desde localStorage y actualizar la vista
function cargarFavoritos() {
    let favoritosKey = getFavoritosKey(); // Obtiene la clave de los favoritos
    const favoritos = JSON.parse(localStorage.getItem(favoritosKey)) || {}; // Carga los favoritos o un objeto vacío si no existen
    const keys = Object.keys(favoritos); // Obtiene las claves de los productos en favoritos
    const totalItems = keys.length; // Cuenta el total de ítems en favoritos
    const inicio = (paginaActual - 1) * itemsPorPagina; // Calcula el índice de inicio para mostrar ítems en la página actual
    const fin = Math.min(inicio + itemsPorPagina, totalItems); // Calcula el índice de fin, asegurándose de no exceder el número total de ítems

    const tbody = document.getElementById('carrito-body'); // Obtiene el elemento tbody donde se listan los favoritos
    tbody.innerHTML = ''; // Limpia cualquier contenido previo en tbody

    // Itera sobre los productos que se deben mostrar en la página actual
    keys.slice(inicio, fin).forEach(id => {
        const producto = favoritos[id]; // Obtiene el producto actual por su clave
        const tr = document.createElement('tr'); // Crea una nueva fila para la tabla
        // Establece el contenido HTML de la fila, incluyendo imagen, enlace al producto, precio y botón para eliminar de favoritos
        tr.innerHTML = `
            <td><img src="${producto.imagen}" alt="${producto.nombre}" style="width: 90px; height: auto; vertical-align: middle; margin-right: 10px;"></td>
            <td><a title="Ir al producto" href="../controller/productoController.php?id=${producto.id}">${producto.nombre}</a></td>
            <td>${producto.precio ? `${producto.precio} €` : 'Precio no disponible'}</td>
            <td>
                <button title="Eliminar" onclick="eliminarDeFavoritos('${id}')" class="btn btn-eliminar"><i class="fa fa-trash"></i></button>
            </td>
        `;
        tbody.appendChild(tr); // Agrega la fila al cuerpo de la tabla
    });

    actualizarPaginacionFavoritos(totalItems); // Llama a la función para actualizar la paginación según el total de ítems
}

// Función para actualizar la paginación basada en el total de ítems en los favoritos
function actualizarPaginacionFavoritos(totalItems) {
    const paginaContainer = document.getElementById('pagination-container'); // Obtiene el contenedor de la paginación
    paginaContainer.innerHTML = ''; // Limpia el contenido anterior del contenedor
    const totalPaginas = Math.ceil(totalItems / itemsPorPagina); // Calcula el total de páginas necesarias

    // Crea y añade botones de paginación al contenedor
    for (let i = 1; i <= totalPaginas; i++) {
        const button = document.createElement('button');
        button.innerText = i;
        button.className = 'page-item pagination-button';
        if (i === paginaActual) {
            button.classList.add('active'); // Marca el botón de la página actual como activo
        }
        button.onclick = function() {
            paginaActual = i;
            cargarFavoritos(); // Recarga los favoritos para la página seleccionada
        };
        paginaContainer.appendChild(button);
    }
}

// Función para eliminar un producto de los favoritos
function eliminarDeFavoritos(id) {
    const favoritosKey = getFavoritosKey(); // Obtiene la clave de los favoritos
    const favoritos = JSON.parse(localStorage.getItem(favoritosKey)); // Carga los favoritos
    if (favoritos && favoritos.hasOwnProperty(id)) {
        delete favoritos[id]; // Elimina el producto específico de los favoritos
        localStorage.setItem(favoritosKey, JSON.stringify(favoritos)); // Guarda los favoritos actualizados en localStorage
        cargarFavoritos(); // Recarga la vista de favoritos
    }
}

// Asegura que la lista de favoritos se carga al iniciar la página
window.onload = function() {
    cargarFavoritos();
};

// Añade un oyente de eventos que actualiza el contador del carrito al terminar de cargar el contenido del DOM
document.addEventListener('DOMContentLoaded', function() {
    actualizarContadorCarrito();
});

// Función para obtener la clave del carrito de compras en localStorage para un usuario específico
function getCarritoKey() {
    const userId = document.body.getAttribute('data-user-id'); // Obtiene el ID del usuario
    return `carrito_${userId}`; // Retorna la clave del carrito
}

// Función para actualizar el contador de ítems en el icono del carrito
function actualizarContadorCarrito() {
    const carritoKey = getCarritoKey(); // Obtiene la clave del carrito
    const carrito = JSON.parse(localStorage.getItem(carritoKey)) || {}; // Carga el carrito o un objeto vacío si no existe
    const totalItems = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0); // Calcula el total de ítems en el carrito
    const contador = document.getElementById('cart-count'); // Obtiene el elemento que muestra el contador
    if (contador) {
        contador.textContent = totalItems; // Actualiza el texto del contador
    }
}
