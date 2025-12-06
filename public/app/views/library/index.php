<?php
require_once "../../../assets/_includes/header.php";
?>

<title>Gestão da Biblioteca</title>
<link rel="stylesheet" href="../../../assets/_css/library/main.css">

  <style>
    /*
    body {
      font-family: Arial, sans-serif;
      background: #f9fff9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      width: 400px;
      border: 2px solid #2ecc71;
    }

    h2 {
      text-align: center;
      color: #2ecc71;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"], input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      transition: border 0.3s;
    }

    input[type="text"]:focus, input[type="file"]:focus {
      border: 1px solid #2ecc71;
    }
    input[type="file"]::-webkit-file-upload-button{
      padding: 10px;
      border: none;
      border-radius: 5px;
      color: #fff;
      background-color: #27ae60;
    }
    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 6px;
      background: #2ecc71;
      color: #fff;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #27ae60;
    }*/
  </style>
<?php
require_once "../../../assets/_includes/menu.php";
?>
  <main>

  <div class="container">
    <h2>Upload de PDF</h2>
    <form id="uploadForm" enctype="multipart/form-data">
      <label for="fileInput">Selecione o PDF</label>
      <input type="file" id="fileInput" name="fileInput" accept="application/pdf">

      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo">

      <label for="autor">Autor:</label>
      <input type="text" id="autor" name="autor">

      <label for="editora">Editora:</label>
      <input type="text" id="editora" name="editora">

      <button type="submit">Enviar</button>
     
    </form>
  </div>
  </main>

  <!-- PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.14.305/pdf.min.js"></script>
  <script>
    const fileInput = document.getElementById("fileInput");
    const tituloInput = document.getElementById("titulo");
    const autorInput = document.getElementById("autor");
    const editoraInput = document.getElementById("editora");
    const form = document.getElementById("uploadForm");

    // Preenche campos com metadados do PDF
    fileInput.addEventListener("change", async (e) => {
      let file = e.target.files[0];
      if (!file) return;

      let arrayBuffer = await file.arrayBuffer();
      let pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
      let meta = await pdf.getMetadata();

      tituloInput.value  = meta.info.Title    || "sem título";
      autorInput.value   = meta.info.Author   || "Desconhecido";
      editoraInput.value = meta.info.Producer || "Desconhecida";
    });

    // Enviar dados via Fetch API
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      tituloInput.value="Desconhecido"
      autorInput.value="Desconhecido"
      editoraInput.value="Desconhecido"

      const file = fileInput.files[0];
      if (!file) {
        alert("Selecione um PDF!");
        return;
      }

      let formData = new FormData(form);
      

       await fetch("http://127.0.0.1/gestao-escolar/public/app/controllers/livros.php", {
        method: "POST",
        body: formData
      })
.then(resposta=>resposta.json())
.then((dados)=>{
  let p=document.createElement("p")
  p.setAttribute("id","msm");
  form.appendChild(p);
  setTimeout(()=>{
    form.removeChild(p);

  },5000)

})
  
    });
  </script>
<?php
require_once "../../../assets/_includes/footer.php";
?>