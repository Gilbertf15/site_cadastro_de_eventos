document
  .getElementById("adicionar_event")
  .addEventListener("click", function () {
    // Obtendo os valores dos inputs
    const status1 = document.getElementById("nome").value;
    const status2 = document.getElementById("local_evento").value;
    const status3 = document.getElementById("status").value;

    // Criando o novo elemento <div> com a classe "texte1"
    const novoelemento = document.createElement("div");
    novoelemento.className = "texte1";

    // Definindo o conteúdo do novo elemento
    novoelemento.innerHTML = `
        <div>
            <p>Nome: ${status1} </p>
            <p>
                <span>Local:</span>
                <strong>${status2}</strong>
            </p>
            <p>
                <span>Status:</span>
                <strong>${status3}</strong>
            </p>
            <div class="ls-txt-right">
                <a href="#" class="btn">Saiba mais</a>
        </div>
    `;

    // Adicionando o novo elemento no container
    const container = document.getElementById("events");
    container.appendChild(novoelemento);

    // Limpar os campos de input após criar o elemento
    document.getElementById("nome").value = "";
    document.getElementById("local_evento").value = "";
    document.getElementById("status").value = "";
  });
