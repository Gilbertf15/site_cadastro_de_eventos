const formulario_login = document.getElementById("form_evento");
const campos_input = document.querySelectorAll(".requi_evento");
const spans = document.querySelectorAll(".span_evento");

// evento de envio de formulario para impedir o envio padrão
formulario_login.addEventListener("submit", (event) => {
  event.preventDefault();
  NomeValido();
  LocalValido();
  DataValida();
  MascaraHora();
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

// função para validar o campo input nome do evento
function NomeValido() {
  if (campos_input[0].value.length < 5) {
    setErrorSpan(0);
  } else {
    removerErrorSpan(0);
  }
  return campos_input[0].value;
}

// função do campo para validar a descrição do local do evento
function LocalValido() {
  if (campos_input[1].value.length < 5) {
    setErrorSpan(1);
  } else {
    removerErrorSpan(1);
  }
  return campos_input[1].value;
}

// função para validar a data do evento
function DataValida() {
  // mascara de campo de data com jquery
  $("#data_ini").mask("00/00/0000");
  $("#data_fim").mask("00/00/0000");
  const intertida_2 = campos_input[2].value;
  const intertida_3 = campos_input[3].value;
  const teste2 = intertida_2.split("").reverse().join("");
  const teste3 = intertida_3.split("").reverse().join("");
  // convertendo as datas para inteiro
  const dataint2 = parseInt(teste2.replace(/\//g, ""), 10);
  const dataint3 = parseInt(teste3.replace(/\//g, ""), 10);
  if (dataint2 > dataint3) {
    setErrorSpan(2);
  } else {
    removerErrorSpan(2);
  }
}

// funçao para adicionar a mascara de campo do horario do evento
function MascaraHora() {
  $("#hora_ini").mask("00:00:00");
  $("#hora_fim").mask("00:00:00");
  console.log($("#hora_ini").cleanVal());
}
