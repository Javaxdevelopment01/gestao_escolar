const url="http://gestao-escolar/public/app/controllers/funcionario.php";
let formulario=document.getElementById("formulario");

let lista_funcionario=document.getElementById("lista-funcionario");
function ListarFuncionario(params) {
    

fetch(url)
.then(respost=>respost.json())
.then((funcionarios)=>{
    lista_funcionario.innerHTML=""
    for (const funcionario of funcionarios) {
        lista_funcionario.innerHTML+=`
           <tr>
              <td>
                <div class="datas">
                  <div class="img">
                    <img src="../${funcionario.img}" alt="" width="100">
                    
                  </div>
                  <div class="info">
                    <strong>${funcionario.nome_funcionario}</strong>
                    <span>${funcionario.email_funcionario}</span>
                  </div>
                </div>
              </td>
              <td>
                <span class="mdi mdi-eye" onclick="MostrarDetalhes(${funcionario.id_funcionario})"></span>
                <span class="mdi mdi-pencil-box"  onclick="Actualizar(${funcionario.id_funcionario})"></span>
                <span class="mdi mdi-delete" onclick="Deleta(${funcionario.id_funcionario})"></span>
              </td>
            </tr>
        `
        
    }

})
}
formulario.addEventListener("submit",(evento) => {
    evento.preventDefault();
    const dados_funcionario=new FormData(formulario)
    const option= {
        method:"post",
        body:dados_funcionario
    } 
    fetch(url,option)
    .then(resposta=>resposta.json())
    .then((msm)=>{
        console.log(msm);
        ListarFuncionario()
        

    })
})
ListarFuncionario();