let btn = document.getElementById("btn-menu")
let menu=document.getElementById("menu-header")
let favicon=document.getElementById("favicon")
let main=document.getElementsByTagName("main")[0]
btn.addEventListener("click", ()=>{
 menu.classList.toggle("desktop")
 if (menu.className=="desktop") {

  favicon.style.width="130px"
  favicon.src="../../../assets/_images/logo_sistema.png"
   btn.classList.add("mdi-menu-left-outline")
   btn.classList.remove("mdi-menu-right-outline")
    main.style.marginLeft=152+"px"
    main.style.width="calc(100% - 152px)"
    
    
  }else{

    favicon.style.width="30px"
    favicon.src="../../../assets/_images/favicon.png"
    btn.classList.remove("mdi-menu-left-outline")
    btn.classList.add("mdi-menu-right-outline")
    main.style.marginLeft=52+"px"
    main.style.width="calc(100% - 52px)"
 }
})
 