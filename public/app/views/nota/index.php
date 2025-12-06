<?php
require_once "../../../assets/_includes/header.php";
?> 
  <title>Lançar Notas - Gestão Escolar</title>

  <!-- usa o mesmo CSS do template (não alteres) -->
  <link rel="stylesheet" href="../SGE/public/assets/_css/turmas/turmas.css">

  <!-- Font Awesome (igual ao resto do projeto) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 
  <!-- bibliotecas para export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

  <!-- micro CSS adicional (apenas para tabela ficar alinhada ao layout; não mexe no sidebar) -->
  <style>
    /* tabela e controles seguem visual do template */
    .content .filters { display:flex; gap:12px; align-items:center; margin-bottom:18px; flex-wrap:wrap; }
    .content .filters select, .content .filters .btn-add, .content .filters input { padding:8px 10px; border-radius:8px; border:1px solid #dbe4ea; }
    .table-container { background:#fff; padding:16px; border-radius:12px; box-shadow:0 8px 20px rgba(0,0,0,0.06); margin-top:10px; }
    #notasTable { width:100%; border-collapse:collapse; }
    #notasTable th, #notasTable td { padding:10px; border-top:1px solid #eef2f6; text-align:left; vertical-align:middle; }
    #notasTable thead th { background: #f7fafb; color:#344; }
    .student-pic { width:44px; height:44px; border-radius:50%; object-fit:cover; box-shadow:0 4px 10px rgba(0,0,0,0.06); }
    .actions-cell button { border:none; background:none; cursor:pointer; font-size:16px; color:#2c3e50; }
    .export-controls { display:flex; gap:8px; margin-top:12px; justify-content:flex-end; }
    .export-controls .btn { padding:8px 12px; border-radius:8px; border:none; cursor:pointer; }
    .btn-export-pdf { background:#e74c3c; color:#fff; }
    .btn-export-xls { background:#27ae60; color:#fff; }
    @media(max-width:900px){ .content .filters { flex-direction:column; align-items:stretch; } }
  </style>
<?php
require_once "../../../assets/_includes/menu.php";
?> 

  <!-- MAIN (mesma estrutura visual) -->
  <main class="main-content">
    

    <section class="content">
      <h1>Lançar Notas</h1>

      <!-- filtros e botão (usa classes do template) -->
      <div class="filters">
        <select id="selectCurso">
          <option value="">-- Curso --</option>
          <option value="INF">Informática</option>
          <option value="GES">Gestão</option>
          <option value="CON">Contabilidade</option>
          <option value="DIR">Direito</option>
        </select>

        <select id="selectTurma">
          <option value="">-- Turma --</option>
          <option value="10A">10ª A</option>
          <option value="10B">10ª B</option>
          <option value="11A">11ª A</option>
        </select>

        <select id="selectDisc">
          <option value="">-- Disciplina --</option>
          <option value="MAT">Matemática</option>
          <option value="POR">Português</option>
          <option value="PROG">Programação</option>
          <option value="FIS">Física</option>
        </select>

        <button class="btn-add" id="carregarAlunos"><i class="fas fa-cloud-download-alt"></i> Carregar Alunos</button>
      </div>

      <!-- tabela -->
      <div class="table-container">
        <table id="notasTable">
          <thead>
            <tr>
              <th>#</th>
              <th>Foto</th>
              <th>Nome</th>
              <th>Nota 1</th>
              <th>Nota 2</th>
              <th>Final</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <!-- preenchido pelo JS -->
          </tbody>
        </table>

        <div class="export-controls">
          <button class="btn-export-pdf btn" id="exportPDF"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
          <button class="btn-export-xls btn" id="exportXLS"><i class="fas fa-file-excel"></i> Exportar Excel</button>
          <button class="btn-add btn" id="salvarNotas"><i class="fas fa-save"></i> Salvar</button>
        </div>
      </div>
    </section>
  </main>

  <!-- script -->
  <script src="../../../assets/_js/lancar notas/lancar_notas.js"></script>
<?php
require_once "../../../assets/_includes/footer.php";
?> 