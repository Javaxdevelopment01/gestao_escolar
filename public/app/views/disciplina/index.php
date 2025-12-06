<?php
require_once "../../../assets/_includes/header.php";
?>

  <title>Disciplinas - Gestão Escolar</title>

  <!-- CSS da aba (usa o teu CSS já existente / ou cria este ficheiro) -->
  <link rel="stylesheet" href="../../../assets/_css/disciplina/disciplnas.css">

  <!-- Font Awesome (já usado no teu projeto) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php
require_once "../../../assets/_includes/menu.php";
?>

  <!-- SIDEBAR (COMPLETO - igual ao modelo das outras abas) -->
 

  <!-- MAIN -->
  <main >

    </header>

    <!-- CONTENT -->
    <section class="content">
      <h1>Disciplinas</h1>
      <button class="btn-add" id="openModal"><i class="fas fa-plus"></i> Nova Disciplina</button>

      <!-- Lista / cards -->
      <div class="cards-container" id="disciplinasContainer">
        <!-- cards gerados dinamicamente pelo JS -->
      </div>
    </section>
  </main>

  <!-- MODAL (cadastro de disciplina) -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>
      <h2>Adicionar Nova Disciplina</h2>

      <form id="disciplinaForm">
        <label for="nome_disciplina">Nome da Disciplina</label>
        <input type="text" name="nome_disciplina" id="nome_disciplina" required>

        <label for="carga_horaria">Carga Horária</label>
        <input type="text" name="carga_horaria" id="carga_horaria" required>

        <label for="id_funcionario">Professor Responsável</label>
        <select name="id_funcionario" id="id_funcionario">

        </select>
        <br>
      


        <button type="submit" class="btn-save">Salvar</button>
      </form>
    </div>
  </div> 

  <!-- JS (usa o teu caminho de scripts) -->
  <script src="../../../assets/_js/disciplina/disciplnas.js"></script>
  <script src="../../../assets/_js/disciplina/requisicoes.js"></script>


<?php
require_once "../../../assets/_includes/footer.php";
?>
