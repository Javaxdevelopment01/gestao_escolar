let biblioteca = document.getElementById("lista-livros")
let searchInput = document.getElementById("search")

let velocidade_animacao=0.5;
function listarBoblioteca(livros) {
    for (const livro of livros) {
        
                biblioteca.innerHTML += `
   <div class="card-book" style="      animation: animacao_texto_writing ${velocidade_animacao}s linear 0s alternate;">
                <div class="img-card">
                    <div class="img">
                         <object data="../../../../public/app/views/${livro.caminho_arquivo}" type=""></object>
                         <div id="irma"></div>
                    </div>
                </div>
                <div class="content-card">
                    <div class="info">
                        <h3>${livro.titulo}</h3>
                        <p>${livro.autor}</p>
                    </div>
                    <div class="controlls">
                    <input type="hidden" value="../../../../public/app/views/${livro.caminho_arquivo}">
                    <a class="mdi mdi-eye" onclick="VisualizarLivro(this.parentElement)">Visualizar</a>
                        <a href="../../../../public/app/views/${livro.caminho_arquivo}" class="mdi mdi-download" target="_blank">Download</a>
                    </div>
                </div>
            </div>
       `
velocidade_animacao+=0.3
if (velocidade_animacao==3.0) {
    velocidade_animacao=0.5
    
}
       
       
    }
    velocidade_animacao=0.5

}
let readbook_container = document.createElement("div")
readbook_container.addEventListener("click", (evento) => {
    if (evento.target.className === "readbook-container") {
        document.body.removeChild(readbook_container)
    }
})
function VisualizarLivro(livro) {

    readbook_container.setAttribute("class", "readbook-container");

    caminho_livro=livro.children[0].value
    readbook_container.innerHTML = `
    <div class="card">
    <object data="${caminho_livro}" type=""></object>
</div>`
  

    document.body.appendChild(readbook_container)

}
const url="http://localhost/gestao-escolar/public/app/controllers/livros.php";
fetch(url)
.then((resposta)=>resposta.json())
.then((livros)=>{
    listarBoblioteca(livros);

})
/*
searchInput.addEventListener("keyup", (livro) => {
    const search = livros.filter(livro_c => livro_c.titulo.toLocaleLowerCase().includes(livro.target.value.toLocaleLowerCase()))
    listarBoblioteca(search);
    console.log(biblioteca.innerHTML + "Seu valor");
    if (biblioteca.innerHTML == false) {
        biblioteca.innerHTML = "<p>:( Item não Encontrado</p>"
    }
})
/**
 * Cadastramento de Livros
 
const cadastramento_livro=document.getElementById("cadastramento_livro")
// Carregamento dos dados
const fileInput=document.getElementById("livro")
fileInput.addEventListener("change",async (evento)=>{
    const file= evento.target.files[0]
    if (!file)return;
    const reader=new FileReader();
    reader.onload=async (e)=>{
        const typedarray=new Uint8Array(e.target.result)
        //carregar pdf com pdf.js
        const pdf=await pdfjsLib.getDocument(typedarray).promise;
        //pegar metadados
        const meta =await pdf.getMetadata();
        //preenchar os campos
        document.querySelector('[name="titulo"]').value=meta.info.Title||"Sem Título";
        document.querySelector('[name="autor"]').value=meta.info.Autor|| "Desconhecido"

        document.querySelector('[name="editora"]').value=meta.info.Producer||"Desconhecido"
        e.preventDefault();
    }
    const url="http://fullstack/projects/sgd/livro.php"
    const formData=new FormData(cadastramento_livro);
    const resposta= await fetch(url,{
        method:'post',
        body:formData
    })
    const resultado=await resposta.text()
    alert(resultado)
    


})

cadastramento_livro.addEventListener("submit",(evento)=>{
    evento.preventDefault();
    const livro=new FormData(cadastramento_livro);
    const url="http://fullstack/projects/sgd/livro.php"
    const option={
        method:'post',
        body:livro
    }
    fetch(url,option)
    .then(resposta=>resposta.json())
    .then((dados)=>{
        listarBoblioteca(dados)
    })

})
*/