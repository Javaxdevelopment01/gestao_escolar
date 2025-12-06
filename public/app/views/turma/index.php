<?php
require_once "../../../assets/_includes/header.php";
?>

  <title>Turmas - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/turmas/turmas.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php
require_once "../../../assets/_includes/menu.php";
?>




<?php
require_once "../../../assets/_includes/footer.php";
?>

   
    <section class="content">
      <h1>Turmas</h1>
      <button class="btn-add" id="openModal" 
       
      ><i class="fas fa-plus"></i> Nova Turma</button>

      <!-- Cards de Turmas -->
      <div class="cards-container" id="turmasContainer">
        <!-- Cards serão adicionados dinamicamente pelo JS -->
      </div>
    </section>
  </main>

  <!-- Modal Formulário -->
  <div class="modal" id="modal">
    <div class="modal-content">
      <span class="close" id="closeModal">&times;</span>
      <h2>Adicionar Nova Turma</h2>
      <form id="turmaForm">
        <label for="anoletivo">Ano Lectivo</label>
        <input type="text" id="anoletivo"  name="anoletivo"  placeholder="Ano Lectivo">
        
        <label for="classe">Classe da Turma</label>
        <select name="classe" id="classe" class="data"></select>

        <label for="curso">Curso</label>
        <select name="curso" id="curso" class="data"></select>
        <label for="sala">Sala</label>
         <select name="sala" id="sala" class="data"></select>
         <label for="periodo">Periodo</label>
         <select name="periodo" id="periodo" class="data"></select>
         
        
        <label for="turma">Turma</label>
     
        <input type="text" name="turma" id="turma"   placeholder="O nome da Turma aparecerá aqui.">
       

        <button type="submit" class="btn-save">Salvar</button>
      </form>
    </div>
  </div>
  <script>
 
  </script>
  <script src="../../../assets/_js/turmas/turmas.js" defer></script>
  <script src="../../../assets/_js/turmas/requisicoes.js" defer></script>
<?php
require_once "../../../assets/_includes/footer.php";
?>