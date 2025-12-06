<?php
require_once "../../../assets/_includes/header.php";
?> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Boletins - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/boletins/boletins.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php
require_once "../../../assets/_includes/menu.php";
?> 

  <!-- Sidebar completa -->
 

  <main class="main-content">
 

    <section class="content">
      <h1>Boletins</h1>

      <div class="filters">
        <select id="selectCurso">
          <option value="">Seleciona Curso</option>
          <option value="Curso1">Informática</option>
          <option value="Curso2">Informática de Gestão</option>
          <option value="Curso3">Contabilidade de Gestão</option>
          <option value="Curso4">Gestão Empresarial</option>
        </select>

        <select id="selectTurma">
          <option value="">Seleciona Turma</option>
          <option value="10A">10A</option>
          <option value="10B">10B</option>
          <option value="11A">11A</option>
          <option value="11B">11B</option>
        </select>

        <select id="selectDisc">
          <option value="">Seleciona Disciplina</option>
          <option value="Matematica">Matemática</option>
          <option value="Fisica">Física</option>
          <option value="TLP">TLP</option>
          <option value="SEAC">SEAC</option>
        </select>

        <button class="btn-add" id="carregarBoletins"><i class="fas fa-eye"></i> Carregar</button>
      </div>

      <div class="export-buttons">
        <button class="btn-add" id="exportPDF"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
        <button class="btn-add" id="exportXLS"><i class="fas fa-file-excel"></i> Exportar Excel</button>
      </div>

      <table id="boletinsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Aluno</th>
            <th>Curso</th>
            <th>Turma</th>
            <th>Disciplina</th>
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
  <script src="../../../assets/_js/Boletins/boletins.js"></script>
<?php
require_once "../../../assets/_includes/footer.php";
?> 