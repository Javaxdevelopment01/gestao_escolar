let portifolio=document.querySelectorAll(".portifolio")[0]
portifolio.style.cursor="pointer"
let div=document.createElement("div")
div.setAttribute("id","fathser-dialog")
portifolio.addEventListener("click",(evet)=>{
 
    addFilho()
    
})
 function addFilho(params) {
    div.innerHTML=`
    <dialog open="" class="user-dialog">
    <section class="data-user user-dialog">
    <div class="info user-dialog">
    <div class="img-user user-dialog">
    <img src="../../assets/_images/30756.jpg" alt="" class="user-dialog" >
    </div>
    <div class="info-user user-dialog">
    <p  class="user-dialog">
    <strong  class="user-dialog">Gabriel Pedro Aurélio</strong>
    <span  class="user-dialog">gabrielpderoaurelio@gmail.com</span>
    
    </p>
    </div>
    </div>
    <div class="option-user user-dialog">
    
    <div class="user-dialog"><span class="user-dialog">Alterar Senha</span> <span class="mdi mdi-edit"></span> </div>
    <div class="user-dialog"><span class="user-dialog">Meus Históricos</span> <span class="mdi mdi-eye"></span></div>
    <div class="user-dialog" onclick="fecharcarduser()"><span class="user-dialog">Fechar</span> <span class="mdi mdi-close"></span></div>
    </div>
    </section>
    
    </dialog>
    
    
    
    `
    addClasse()

    document.body.appendChild(div)
}
function addClasse(params) {
    
    div.setAttribute("class","c")
}

 function fecharcarduser(){
  //  div.addEventListener("click",  (evet)=>{
       // console.log(evet.target);
        //evet.stopPropagation()
      addFilho()
        document.body.removeChild(div)
    
    
 //   })
 }


/**
 * Codigo para o btn do logout 
 * 
 */
let btn_logout=document.querySelector(".btn-logout")
let  div_card_logout=document.querySelectorAll("body>div")[0]
let option_btn_logout_no=document.getElementById("option-btn-logout-no")

option_btn_logout_no.addEventListener("click",()=>{
    div_card_logout.removeAttribute("class")
})
btn_logout.addEventListener("click", ()=>{
div_card_logout.setAttribute("class", "card-logaout")
})