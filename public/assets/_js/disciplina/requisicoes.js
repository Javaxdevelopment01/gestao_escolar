const url="http://gestao-escolar/public/app/controllers/disciplina.php"
const disciplinasContainer=document.getElementById("disciplinasContainer")
function Listar(params) {
        fetch(url)
    .then(resposta=>resposta.json())
    .then(disciplinas=>{
        disciplinasContainer.innerHTML=""
        for (const disciplina of disciplinas) {
             const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
          <i class="fas fa-book" aria-hidden="true"></i>
          <h3>${disciplina.nome_disciplina}</h3>
          <p><strong>Carga:</strong> ${disciplina.carga_horaria}</p>
          <p><strong>Professor:</strong> ${disciplina.nome_funcionario}</p>
          <div class="card-actions">
            <button class="btn-edit" data-index="${disciplina.id_disciplina}" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn-delete" data-index="${disciplina.id_disciplina}" title="Excluir"><i class="fas fa-trash"></i></button>
          </div>
        `;
        disciplinasContainer.appendChild(card);
        console.log("Disciplinas");
        
            
        }
    })


}
Listar()

function listarProfessores(params) {
    const id_funcionarioDiv=document.getElementById("id_funcionario")
    console.log("gads");
    const urlProfesso="http://gestao-escolar/public/app/controllers/professor.php";
            id_funcionarioDiv.innerHTML=""
    fetch(urlProfesso)
    .then(resposta=>resposta.json())
    .then(professores=>{
        id_funcionarioDiv.innerHTML=""
        for (const professor of professores) {
            const option=document.createElement("option")
            option.setAttribute("value",professor.id_funcionario)
            option.innerHTML=professor.nome_funcionario
            id_funcionarioDiv.appendChild(option)
            
        }
        
    }).catch(erro=>{
        console.log(erro);
        
    })
}
listarProfessores()
const disciplinaForm=document.getElementById("disciplinaForm")
disciplinaForm.addEventListener("submit",(evento)=>{
    evento.preventDefault()
    const formulario=new FormData(disciplinaForm)
           for (const element of formulario) {
        console.log(element);
        
    }
    fetch(url,{
        method:"post",
        body:formulario
    })
    .then(resposta=>resposta.json())
    .then(disciplinas=>{
        console.log(disciplinas);
        Listar();
        
    }).catch(erro=>{
        console.log(erro);
        
    })


})
