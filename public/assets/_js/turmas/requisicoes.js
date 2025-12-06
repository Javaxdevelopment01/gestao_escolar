let url = "http://gestao-escolar/public/app/controllers/turmas.php";
//url="http://localhost/gestao-escolar/public/app/controllers/turmas.php"
const turmasContainer = document.getElementById("turmasContainer");
function escapeHtml(str) {
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}
let ListaTurmas = []
fetch(url)
  .then((resposta) => resposta.json())
  .then((turmas) => {
    ListaTurmas = turmas;
    turmasContainer.innerHTML = ""
    turmas.forEach(turma => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <i class="fas fa-users" aria-hidden="true"></i>
        <h3>${escapeHtml(turma.turma)}</h3>
        <p><strong>Curso:</strong> ${escapeHtml(turma.curso)}</p>
        <p><strong>Ano:</strong> ${escapeHtml(turma.ano)}</p>
        <p><strong>Sala:</strong> ${escapeHtml(turma.numero_sala)}</p>
        <p><strong>Periodo</strong> ${escapeHtml(turma.periodo)}</p>
        <p><strong>Classe</strong> ${escapeHtml(turma.classe)}</p>
        <div class="card-actions">
          <button class="btn-edit" data-index="${turma.id_turma}" title="Editar"><i class="fas fa-edit"></i></button>
          <button class="btn-delete" data-index="${turma.id_turma}" title="Excluir"><i class="fas fa-trash"></i></button>
        </div>
      `;
      turmasContainer.appendChild(card);
    });

  })

/*
Cadastrar Turma
*/

function Atribuir(params) {
  console.log("chamou");

  const classe = document.getElementById("classe");
  const curso = document.getElementById("curso");
  const sala = document.getElementById("sala");
  const periodo = document.getElementById("periodo");

  const urlClasse = "http://localhost/gestao-escolar/public/app/controllers/classe.php"
  const urlSala = "http://localhost/gestao-escolar/public/app/controllers/salag.php"
  const urlCurso = "http://localhost/gestao-escolar/public/app/controllers/cursog.php"
  const urlCPeriodo = "http://localhost/gestao-escolar/public/app/controllers/periodo.php"

  fetch(urlClasse)
    .then(resposta => resposta.json())
    .then(Classes => {
      Classes.forEach(element => {
        let option = document.createElement("option")
        option.value = element.id_classe
        option.innerHTML = element.classe
        classe.appendChild(option)


      });
    })
    .catch(errro => {
      console.log(errro);

    })
  fetch(urlSala)
    .then(resposta => resposta.json())
    .then(Salas => {
      Salas.forEach(element => {
        let option = document.createElement("option")
        option.value = element.id_sala
        option.innerHTML = element.numero_sala
        sala.appendChild(option)

      });
    })
    .catch(errro => {
      console.log(errro);

    })
  fetch(urlCurso)
    .then(resposta => resposta.json())
    .then(Cursos => {
      Cursos.forEach(element => {
        let option = document.createElement("option")
        option.value = element.id_curso
        option.innerHTML = element.curso
        curso.appendChild(option)


      });
    })
    .catch(errro => {
      console.log(errro);

    })
  fetch(urlCPeriodo)
    .then(resposta => resposta.json())
    .then(CPeriodos => {
      CPeriodos.forEach(element => {
        let option = document.createElement("option")
        option.value = element.id_periodo
        option.innerHTML = element.periodo
        periodo.appendChild(option)


      });
    })
    .catch(errro => {
      console.log(errro);

    })
}
function DatarAno(params) {
  let data = new Date();
  const ano = document.getElementById("anoletivo")

  ano.value = 3023

  Atribuir();

}
DatarAno()









document.querySelectorAll(".data, #anoletivo").forEach(input => {
    input.addEventListener("change", gerarTurma);
});

function gerarTurma() {
    const sala = document.getElementById("sala").value.substring(0,2);
    const curso = document.getElementById("curso").value.substring(0,2);
    const classe = document.getElementById("classe").value.substring(0,2);
    const periodo = document.getElementById("periodo").value.substring(0,2);
    const ano = document.getElementById("anoletivo").value.substring(0,2);

    let turma = "";

    if (sala && curso && classe && periodo && ano) {
        turma = `${sala}${curso}${classe}${periodo}${ano}`;
    }

    document.getElementById("turma").value = turma.toUpperCase(); // fica em maiúsculas
}