// Función para desplazarse suavemente hacia arriba
function scrollToTop() {
  window.scrollTo({
      top: 0,
      behavior: 'smooth'
  });
}

// Mostrar/ocultar el botón al hacer scroll
window.onscroll = function() {
  scrollFunction();
};

function scrollFunction() {
  const btnSubir = document.getElementById('btnSubir');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      btnSubir.style.display = 'block';
  } else {
      btnSubir.style.display = 'none';
  }
}

// Funciones que dependen del DOM completamente cargado
document.addEventListener('DOMContentLoaded', function() {
  // Filtros responsive - manejo del botón de mostrar/ocultar filtros
  const toggleBtn = document.getElementById('toggleFiltrosBtn');
  const filtroColumna = document.getElementById('filtroColumna');

  if (toggleBtn && filtroColumna) {
      toggleBtn.addEventListener('click', function() {
          filtroColumna.classList.toggle('d-none');
          filtroColumna.classList.toggle('active');
          toggleBtn.textContent = toggleBtn.textContent === "Mostrar Filtros" ? "Ocultar Filtros" : "Mostrar Filtros";
      });
  }
});
