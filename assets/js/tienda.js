  //* Función para desplazarse suavemente hacia arriba
  function scrollToTop() {
    //* Desplazamiento suave hacia arriba
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  }

  //* Mostrar/ocultar el botón al hacer scroll
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

  //* Transform value
  let value = 0
  //* trail index number
  let trailValue = 0
  //* interval (Duration)
  let interval = 4000

  //* Select Tienda
  const opcionMenu = document.querySelector(".select-menu"),
          selectBtn = opcionMenu.querySelector(".select-btn"),
          opciones = opcionMenu.querySelectorAll(".opcion"),
          selectBtn_texto = opcionMenu.querySelector(".selectBtn-texto");

  selectBtn.addEventListener("click", () => opcionMenu.classList.toggle("active"));

  opciones.forEach(opcion =>{
    opcion.addEventListener("click", () =>{
      let opcionSeleccionada = opcion.querySelector(".opcion-texto").innerText;
      selectBtn_texto.innerText = opcionSeleccionada;

      opcionMenu.classList.remove("active");
    })
  })

  //?filtros responsive
  $(document).ready(function () {
    //? Manejador de clic para el botón de mostrar/ocultar filtros
    $("#toggleFiltrosBtn").click(function () {
        $("#filtroColumna").toggleClass("d-none");
        $("#filtroColumna").toggleClass("active");  //? Añade esta línea
        var buttonText = $("#toggleFiltrosBtn").text();
        $("#toggleFiltrosBtn").text(buttonText === "Mostrar Filtros" ? "Ocultar Filtros" : "Mostrar Filtros");
    });
});
