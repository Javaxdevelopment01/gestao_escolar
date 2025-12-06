<?php
require_once "../../../assets/_includes/header.php";
?>
  <title>Alunos - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/aluno/aluno.css">
  <link rel="stylesheet" href="../../../assets/_css/aluno/show-plus.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../../../assets/libs/@mdi/css/materialdesignicons.css">
<?php
require_once "../../../assets/_includes/menu.php";
?> 

  <!-- Main -->
  <main class="main-content">
    

    <section class="content">
  <h1>Alunos</h1>
  <button class="btn-add" id="openModal"><i class="fas fa-plus"></i> Novo Aluno</button>

  <!-- Cards de Alunos -->
  <div class="cards-container" id="alunosContainer">
    <!-- Cards serão adicionados dinamicamente pelo JS -->
  </div>
</section>

  </main>

  <!-- Modal Formulário -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>
      <h2>Adicionar Novo Aluno</h2>
      <form id="alunoForm" enctype="multipart/form-data">
        <label for="nome_aluno">Nome do Aluno</label>
        <input type="text" id="nome_aluno" name="nome_aluno" required  class="input-form">

        <label for="sobrenome_aluno">SobreNome do Aluno</label>
        <input type="text" id="sobrenome_aluno" name="sobrenome_aluno" required  class="input-form">

        
        <label for="email_aluno">Email</label>
        <input type="email" id="email_aluno" name="email_aluno" required  class="input-form">
        <label for="email_aluno">Numero do B.I</label>
        <input type="text" id="bi_aluno" name="bi_aluno"required  class="input-form">
        <label for="numero_matricula_aluno">Nº de Matricula</label>
        <input type="text" id="numero_matricula_aluno" name="numero_matricula_aluno" required  class="input-form">

        <label for="id_turma">Turma</label>
        <select name="id_turma" id="id_turma">
          <option value="1">01ECT24</option>
          <option value="1">01ECT24</option>
          <option value="1">01ECT24</option>
          <option value="1">01ECT24</option>
          <option value="1">01ECT24</option>
        </select>     
     <label for="status_aluno">Turma</label>
        <select name="status_aluno" id="status_aluno">
          <option value="Frequentando">Frequentando</option>
          <option value="Finalista">Finalista</option>
          <option value="Transferido">Transferido</option>
          <option value="Expulso">Expulso</option>
          <option value="Inativo">Inativo</option>
        </select>
        <label for="curso">Provincia Residencia</label>
        <input type="text" id="provincia_regidencia" name="provincia_regidencia" required class="input-form">
        <label for="curso">Municipio Residencia</label>
        <input type="text" id="municipio_regidencia" name="municipio_regidencia" required class="input-form">
        <label for="curso">Bairro Residencia</label>
        <input type="text" id="bairro_regidencia" name="bairro_regidencia" required class="input-form">
     

        <label for="telefone">Nº de Telefone</label>
        <input type="tel" id="telefone" name="telefone" required class="input-form">

        <label for="foto">Foto</label>
        <input type="file" id="foto_aluno" name="foto_aluno" accept="image/*">
        <div class="card-img">
          <div class="img">
            <img src="" alt="" id="img-preview">
          </div>
        </div>

        <button type="submit" class="btn-save">Salvar</button>
        <p id="mensagens">
          
        </p>
      </form>
    </div>
  </div>
 
  <script src="../../../assets/_js/aluno/requisicao.js" defer></script>
  <script src="../../../assets/_js/aluno/aluno.js" defer></script>
</body>
</html>
<?php
require_once "../../../assets/_includes/footer.php";
?>
