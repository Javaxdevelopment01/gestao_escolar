let btn_assistente = document.getElementById("btn-assistente")
let searchAssistente = document.getElementById("search-assistente")
let inputFieldAssistente = document.getElementById("input-field-assistente")
let assistente_div = document.getElementById("assistente-div")
btn_assistente.addEventListener("click", () => {
    assistente_div.classList.toggle("expandir")

})
searchAssistente.addEventListener("click", () => {
    let texto_Pesquisa = inputFieldAssistente.value
    texto_Pesquisa = texto_Pesquisa.toLowerCase()
    buscarInformacoa(texto_Pesquisa)

    
})
async function buscarInformacoa(texto) {
    const saida = await verificarMemoria(texto)
    speechSynthesis.speak(new SpeechSynthesisUtterance(saida))
    
}
function verificarMemoria(texto) {
    return "O Estoque é o terceriro item do menu, é nele onde você pode gerenciar seus
}
/**
 * codigo para o assistente ouvir
 * btn_audio.addEventListener("click",()=>{
const recognition=new (window.SpeechRecognition|| window.webkitSpeechRecognition)();
recognition.lang="pt-BR";
recognition.start();
})

* 
*/
/*
Código Que faz oo pc falar
speechSynthesis.speak(new SpeechSynthesisUtterance(saida))

*/