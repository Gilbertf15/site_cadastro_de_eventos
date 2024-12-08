const formulario = document.getElementById("form_");
const campos_input = document.querySelectorAll(".requi");
const spans = document.querySelectorAll(".span_requi");
// regex para validação de email//
const email_valid = /\S+@\S+\.\S+/;

// evento de envio de formulario para impedir o envio padrão

//condição de mensagem de alerta caso o cadastro seja realizado
if (nome != "" && email != "" && senha != "" && telefone != "") {
  document.getElementById("result_cad").style.display = "block";
  document.getElementById("result_cad").style.color = "green";
  alert("cadastro feito com sucesso");
} else {
  document.getElementById("result_cad").style.display = "none";
}

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
// funçao para validar o campo input nome
function NomeValido() {
  if (campos_input[1].value.length < 5) {
    setErrorSpan(1);
  } else {
    removerErrorSpan(1);
  }
  return campos_input[1].value;
}
// função para validar o campo de email a partir de um regex
function EmailValido() {
  if (!email_valid.test(campos_input[0].value)) {
    setErrorSpan(0);
  } else {
    removerErrorSpan(0);
  }
  return campos_input[0].value;
}
// funçao para validar o campo input senha
function senhaValida() {
  if (campos_input[2].value.length < 8) {
    setErrorSpan(2);
  } else {
    removerErrorSpan(2);
  }
  return campos_input[2].value;
}
// função para validar numero de telefone
function NumeroValido() {
  // utilização de uma mascara de campo com jquery
  $("#tele").mask("(00) 0000-0000");
  if (campos_input[3].value.length < 11) {
    setErrorSpan(3);
  } else {
    removerErrorSpan(3);
  }
  return campos_input[3].value;
}
