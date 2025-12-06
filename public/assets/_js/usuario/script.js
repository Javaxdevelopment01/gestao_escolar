let card=document.getElementById("container-add-user")
function MostrarModel(params) {
card.classList.add("activo")
    
}
card.addEventListener("click",(evento)=>{
    if (evento.target==card) {
        card.classList.remove("activo")
        
    }
})