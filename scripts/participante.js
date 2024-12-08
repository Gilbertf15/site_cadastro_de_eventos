const formulario_login = document.getElementById("form_");
const campos_input = document.querySelectorAll(".requi_part");
const spans = document.querySelectorAll(".span_part");

// evento de envio de formulario para impedir o envio padrão
formulario_login.addEventListener("submit", (event) => {
  event.preventDefault();
  NomeValido();
  CpfValido();
});

// função para caso ocorrer erro, mostrar a mensagem do span
function setErrorSpan(index) {
  campos_input[index].style.border = "1px solid red";
  spans[index].style.display = "block";
}

// função para caso não tenha erro, retirar a mensagem de span
function removerErrorSpan(index) {
  campos_input[index].style.border = "";
  spans[index].style.display = "none";
}

// função para validar o campo input nome do usuário
function NomeValido() {
  if (campos_input[0].value.length < 8) {
    setErrorSpan(0);
  } else {
    removerErrorSpan(0);
  }
  return campos_input[0].value;
}

//funçao para validar o compo input cpf
function CpfValido() {
  // mascara de campo para cpf com jquery
  $("#cpf").mask("000.000.000-00", { reverse: true });
  if (campos_input[1].value.length < 11) {
    setErrorSpan(1);
  } else {
    removerErrorSpan(1);
  }
  return campos_input[1].value;
}
