const input_foto_cadastro_aluno=document.getElementById("img")
const foto_cadastro_aluno=document.getElementById("img-preview")
input_foto_cadastro_aluno.addEventListener("change", (evento) => {
    const file = evento.target.files[0]
    if (file) {
        foto_cadastro_aluno.src = URL.createObjectURL(file)//criar um url temporario para a imagems selecionada

    }

}) 
let model_form=document.getElementById("model-form")
model_form.addEventListener("click",(evento)=>{
    if (evento.target==model_form) {
        
        model_form.classList.remove("model-form")
    }
})
function add(params) {
    model_form.classList.add("model-form")
    
}
