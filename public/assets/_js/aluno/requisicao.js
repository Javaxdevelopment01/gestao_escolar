/*
Cadastramento de alunos
*/

const caixa_mensagem = document.getElementById("mensagens");
const campos = [...document.querySelectorAll("input.input-form")]
let url = "http://gestao-escolar/public/app/controllers/aluno.php";
//url="http://localhost/gestao-escolar/public/app/controllers/aluno.php"
let formulario = document.getElementById("alunoForm")
formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();
    const Aluno = new FormData(formulario);
    const option = {
        method: "post",
        body: Aluno
    }

    fetch(url, option)
        .then(resposta => resposta.json())
        .then((mensagem) => {

            campos.forEach((campo) => {
                campo.value = ""

            });
            if (mensagem.Mensagem === "") {

            }
            switch (mensagem.Mensagem) {
                case "Salvo Com Sucesso!":
                    caixa_mensagem.style.color = "var(--bs-green);";

                    caixa_mensagem.innerHTML = mensagem.Mensagem
                    setTimeout(() => {
                        caixa_mensagem.innerHTML = "";

                    }, 5000)

                    break;
                case "Aluno não Cadastrado <br> Só Aceitamos Arquivos do tipo Imagem":
                    caixa_mensagem.style.color = "var(--bs-red);";

                    caixa_mensagem.innerHTML = mensagem.Mensagem
                    setTimeout(() => {
                        caixa_mensagem.innerHTML = "";

                    }, 5000)

                    break;
                case "Aluno não cadastrado <br> Não Foi possiver Realizar o Upload da Imagem!":
                    caixa_mensagem.style.color = "var(--bs-red);";

                    caixa_mensagem.innerHTML = mensagem.Mensagem
                    setTimeout(() => {
                        caixa_mensagem.innerHTML = "";

                    }, 5000)

                    break;


                default:
                    break;
            }

        })



});

/*
Listar de alunos

*/

const lista_alunos = document.getElementById("alunosContainer")
const div_carregamento = document.createElement("div")
div_carregamento.setAttribute("class", "divCarregamento")


fetch(url)
    .then(resposta => resposta.json())
    .then((alunos) => {
        alunos.forEach((aluno) => {
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <img src="../${aluno.img}" alt="${aluno.nome_aluno}">
                <h3>${aluno.nome_aluno}</h3>
                <p>Turma: ${aluno.turma}</p>
                <p>Sala: ${aluno.numero_sala}</p>
                <p>Curso: ${aluno.curso}</p>
                <div class="card-actions">
                    <button class="btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" title="Excluir"><i class="fas fa-trash"></i></button>
                    <button onclick="Expandir(${aluno.id_aluno})" title="Excluir"><i class="mdi mdi-eye"></i></button>
                </div>
            `;



            lista_alunos.appendChild(card);

        })

    })
async function Expandir(codigo_aluno) {
    fetch(url)
        .then(resposta => resposta.json())
        .then((alunos) => {
            alunos.forEach((aluno) => {
            if (aluno.id_aluno==codigo_aluno) {
                const card_detalhes=document.createElement("div")
               
                card_detalhes.setAttribute("class","show-plus")
                card_detalhes.innerHTML=`
                        <div class="card">
                        <div class="card-header">
                        <div class="img">
                        <img src="../${aluno.img}" alt="">
                        </div>
                        <h3>${aluno.nome_aluno}</h3>
                        <span>${aluno.curso}</span> <br>
                        <span>${aluno.turma}</span><br>
                        <span>${aluno.classe}</span> <br>
                        </div>
                        <div class="body">

                        <div class="data-card">
                        <span>E-mail</span>
                        <span>${aluno.email}</span>
                        </div>
                        <div class="data-card">
                        <span></span>
                        <span>gabr</span>
                        </div>
                        <div class="data-card">
                        <span>E-mail</span>
                        <span>gabr</span>
                        </div>
                        <div class="data-card">
                        <span>E-mail</span>
                        <span>gabr</span>
                        </div>
                        <div class="data-card">
                        <span>E-mail</span>
                        <span>gabr</span>
                        </div>
                        <div class="data-card">
                        <span>E-mail</span>
                        <span>gabr</span>
                        </div>
                        <div class="data-card">
                        <span>E-mail</span>
                        <span>gabr</span>
                        </div>
                        </div>


    </div>
                `;

                
                document.body.appendChild(card_detalhes);
                 card_detalhes.addEventListener("click",(evento)=>{
                    if (evento.target.className=="show-plus") {
                        document.body.removeChild(card_detalhes)
                    }
                })
            }




            })

        })

}
/*
 <div class="show-plus">
    <div class="card">
      <div class="card-header">
        <div class="img">
          <img src="" alt="">
        </div>
        <h3>Nome</h3>
        <span>Curso</span> <br>
        <span>Turma</span><br>
        <span>Classe</span> <br>
      </div>
      <div class="body">
        
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span></span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
        <div class="data-card">
          <span>E-mail</span>
          <span>gabr</span>
        </div>
      </div>
      

    </div>
  </div>
*/