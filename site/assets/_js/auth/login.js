let inputField = document.querySelectorAll(".input-field")
let inputbtnSubmit = document.querySelector("#btn-login")
let formulario = document.querySelector("#formulario")
inputField.forEach((input) => {
    input.addEventListener("input", validar_campos)
    console.log(inputbtnSubmit.value);
})
function validar_campos(params) {
    let v=inputField[2].value
    v=v.toString()
      if (inputField[0].value == false || inputField[1].value == false || inputField[2].value == false || v.length<8) {
        
          inputbtnSubmit.classList.remove("activo")
   
        }else{
            inputbtnSubmit.classList.add("activo")
          
       

        
      }

}
let logo_title=document.querySelector("#logo-title")
let main=document.querySelectorAll("main")[0]
function mostrar(params) {
    setTimeout(()=>{
main.classList.add("activo")

    },500)
    setTimeout(()=>{
logo_title.classList.add("show-text")

    },1000)
}
inputField[1].addEventListener("input",()=>{
    const email_validade=validaderEmail(inputField[1])
    if (email_validade) {
       
        console.log("Validado");
    } else {
        console.log("N validade");
    }


})
formulario.addEventListener("submit",(evento)=>{
evento.preventDefault()
const url="http://extrasoft/public/app/models/Usuario.php"
const formulario_dados=new FormData(formulario)
const option={
    method:"delete",
    body:formulario_dados
}
fetch(url,option)
.then(response=>response.text())
.then((dado)=>{
    console.log(dado);
})

})