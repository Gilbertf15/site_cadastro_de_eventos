const formulario_login = document.getElementById("form_");
const campos_input = document.querySelectorAll(".requi_org");
const spans = document.querySelectorAll(".span_org");

// evento de envio de formulario para impedir o envio padrão
formulario_login.addEventListener("submit", (event) => {
  event.preventDefault();
  NomeValido();
  CnpjValido();
});

// função para caso ocorrer erro mostrar a mensagem do span
function setErrorSpan(index) {
  campos_input[index].style.border = "1px solid red";
  spans[index].style.display = "block";
}

// função para caso não tenha erro retirar a mensagem de span
function removerErrorSpan(index) {
  campos_input[index].style.border = "";
  spans[index].style.display = "none";
}
// função para validar o campo input nome
function NomeValido() {
  if (campos_input[0].value.length < 8) {
    setErrorSpan(0);
  } else {
    removerErrorSpan(0);
  }
  return campos_input[0].value;
}

// função para validar o campo input cnpj
function CnpjValido() {
  // mascara de campo do cnpj com jquery
  $("#cnpj").mask("00.000.000/0000-00", { reverse: true });
  if (campos_input[1].value.length < 14) {
    setErrorSpan(1);
  } else {
    removerErrorSpan(1);
  }
  return campos_input[1].value;
}
