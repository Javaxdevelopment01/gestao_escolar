<?php
require_once "../../../assets/_includes/header.php";
?>

  <title>Ver Pauta - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/ver pauta/ver_pauta.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php
require_once "../../../assets/_includes/menu.php";
?>

  <main class="main-content">
 

    <section class="content">
      <h1>Ver Pauta</h1>

      <div class="filters">
        <select id="selectCurso">
          <option value="">Seleciona Curso</option>
          <option value="Curso1">Informática</option>
          <option value="Curso2">Informática de Gestão</option>
          <option value="Curso2">Contabilidade de Gestão</option>
          <option value="Curso2">Gestão Empressarial</option>
        </select>

        <select id="selectTurma">
          <option value="">Seleciona Turma</option>
          <option value="10A">10A</option>
          <option value="10B">11B</option>
          <option value="10B">12C</option>
          <option value="10B">13D</option>
        </select>

        <select id="selectDisc">
          <option value="">Seleciona Disciplina</option>
          <option value="Matematica">Matemática</option>
          <option value="Fisica">Física</option>
          <option value="Fisica">TLP</option>
          <option value="Fisica">SEAC</option>
        </select>

        <button class="btn-add" id="carregarPauta"><i class="fas fa-eye"></i> Carregar</button>
      </div>

      <div class="export-buttons">
        <button class="btn-add" id="exportPDF"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
        <button class="btn-add" id="exportXLS"><i class="fas fa-file-excel"></i> Exportar Excel</button>
      </div>

      <table id="pautaTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Nota 3</th>
            <th>Final</th>
          </tr>
        </thead>
        <tbody>
          <!-- Dados carregados pelo JS -->
        </tbody>
      </table>
    </section>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script src="../../../assets/_js/ver pauta/ver_pauta.js"></script>

<?php
require_once "../../../assets/_includes/footer.php";
?>