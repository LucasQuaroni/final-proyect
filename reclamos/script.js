function mostrarFormularioRegistroCliente() {
  var formularioRegistroCliente = document.getElementById(
    "formularioRegistroCliente"
  );
  var btnValidarCliente = document.getElementById("btnValidarCliente");

  // Oculta el botón "Validar Cliente" y muestra el formulario de registro
  btnValidarCliente.style.display = "none";
  formularioRegistroCliente.style.display = "block";
}

const prov = [
  "Buenos Aires",
  "Catamarca",
  "Chaco",
  "Chubut",
  "Córdoba",
  "Corrientes",
  "Entre Ríos",
  "Formosa",
  "Jujuy",
  "La Pampa",
  "La Rioja",
  "Mendoza",
  "Misiones",
  "Neuquén",
  "Río Negro",
  "Salta",
  "San Juan",
  "San Luis",
  "Santa Cruz",
  "Santa Fe",
  "Santiago del Estero",
  "Tierra del Fuego",
  "Tucumán",
];

const selectProv = document.getElementById("provincias");
prov.forEach((provincia) => {
  const option = document.createElement("option");
  option.value = provincia;
  option.textContent = provincia;
  selectProv.appendChild(option);
});
