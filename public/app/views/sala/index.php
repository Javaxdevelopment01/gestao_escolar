
<?php
require_once "../../../assets/_includes/header.php";
?>
  <title>Salas & Blocos - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/Salas e blocos/salas_blocos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   
<?php
require_once "../../../assets/_includes/menu.php";
?>
  <main class="main-content">
    

    <section class="content">
      <h1>Salas & Blocos</h1>

      <div class="filters">
        <select id="selectBloco">
          <option value="">Seleciona Bloco</option>
          <option value="Bloco 1">Bloco 1</option>
          <option value="Bloco 2">Bloco 2</option>
        </select>

        <button class="btn-add" id="carregarSalas"><i class="fas fa-eye"></i> Carregar Salas</button>
      </div>

      <div class="export-buttons">
        <button class="btn-add" id="exportPDF"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
        <button class="btn-add" id="exportXLS"><i class="fas fa-file-excel"></i> Exportar Excel</button>
      </div>

      <table id="salasTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome da Sala</th>
            <th>Bloco</th>
            <th>Capacidade</th>
          </tr>
        </thead>
        <tbody>
          <!-- Dados carregados pelo JS -->
        </tbody>
      </table>
    </section>
<!-- Modal Adicionar Sala -->
<div id="modalAddSala" class="modal">
  <div class="modal-content">
    <span class="close-modal">&times;</span>
    <h2>Adicionar Nova Sala</h2>
    <form id="formAddSala">
      <label for="inputSala">Nome da Sala</label>
      <input type="text" id="inputSala" placeholder="Ex: Sala 108" required>

      <label for="selectBlocoModal">Bloco</label>
      <select id="selectBlocoModal" required>
        <option value="">Seleciona Bloco</option>
        <option value="Bloco 1">Bloco 1</option>
        <option value="Bloco 2">Bloco 2</option>
        <option value="Bloco 3">Bloco 3</option>
        <option value="Bloco 4">Bloco 4</option>
      </select>

      <label for="inputCapacidade">Capacidade</label>
      <input type="number" id="inputCapacidade" placeholder="Ex: 30" required min="1">

      <button type="submit" class="btn-add">Adicionar Sala</button>
    </form>
  </div>
</div>

    
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script src="../../../assets/_js/Salas e Blocos/salas_blocos.js"></script>

<?php
require_once "../../../assets/_includes/footer.php";
?>