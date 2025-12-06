// ver_pauta.js
(() => {
  // Exemplo de dados: 4 cursos, 4 turmas, 4 disciplinas
  const dados = {
    "Curso1": {
      "10A": {
        "Matematica": [
          { nome: "Ana Silva", nota1: 15, nota2: 16, nota3: 14 },
          { nome: "João Pedro", nota1: 12, nota2: 14, nota3: 13 },
          { nome: "Maria Lopes", nota1: 18, nota2: 17, nota3: 19 }
        ],
        "Fisica": [
          { nome: "Ana Silva", nota1: 14, nota2: 15, nota3: 13 },
          { nome: "João Pedro", nota1: 13, nota2: 14, nota3: 12 },
          { nome: "Maria Lopes", nota1: 17, nota2: 18, nota3: 16 }
        ]
      },
      "10B": {
        "Matematica": [
          { nome: "Carlos Pinto", nota1: 11, nota2: 13, nota3: 12 },
          { nome: "Sara Costa", nota1: 15, nota2: 16, nota3: 14 },
          { nome: "Miguel Santos", nota1: 14, nota2: 14, nota3: 15 }
        ],
        "Fisica": [
          { nome: "Carlos Pinto", nota1: 12, nota2: 13, nota3: 14 },
          { nome: "Sara Costa", nota1: 16, nota2: 15, nota3: 16 },
          { nome: "Miguel Santos", nota1: 14, nota2: 13, nota3: 15 }
        ]
      }
    },
    "Curso2": {
      "11A": {
        "TLP": [
          { nome: "Lúcia Marques", nota1: 15, nota2: 14, nota3: 16 },
          { nome: "Pedro Alves", nota1: 13, nota2: 14, nota3: 12 }
        ],
        "SEAC": [
          { nome: "Lúcia Marques", nota1: 16, nota2: 17, nota3: 15 },
          { nome: "Pedro Alves", nota1: 14, nota2: 13, nota3: 15 }
        ]
      }
    }
  };

  const selectCurso = document.getElementById('selectCurso');
  const selectTurma = document.getElementById('selectTurma');
  const selectDisc = document.getElementById('selectDisc');
  const carregarBtn = document.getElementById('carregarPauta');
  const tbody = document.querySelector('#pautaTable tbody');
  const exportPDFbtn = document.getElementById('exportPDF');
  const exportXLSbtn = document.getElementById('exportXLS');
  const globalSearch = document.getElementById('globalSearch');

  function computeFinal(n1, n2, n3) {
    const notas = [parseFloat(n1), parseFloat(n2), parseFloat(n3)].filter(x => !isNaN(x));
    if (!notas.length) return '';
    const soma = notas.reduce((s, v) => s + v, 0);
    return (soma / notas.length).toFixed(1);
  }

  function carregarTabela() {
    const curso = selectCurso.value;
    const turma = selectTurma.value;
    const disc = selectDisc.value;

    tbody.innerHTML = '';
    if (!curso || !turma || !disc) {
      alert('Seleciona Curso, Turma e Disciplina.');
      return;
    }

    const alunos = (dados[curso] && dados[curso][turma] && dados[curso][turma][disc]) || [];
    if (!alunos.length) {
      tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;color:#6b7a8c;">Nenhum aluno encontrado.</td></tr>`;
      return;
    }

    alunos.forEach((a, idx) => {
      const final = computeFinal(a.nota1, a.nota2, a.nota3);
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${idx + 1}</td>
        <td>${a.nome}</td>
        <td>${a.nota1}</td>
        <td>${a.nota2}</td>
        <td>${a.nota3}</td>
        <td>${final}</td>
      `;
      tbody.appendChild(tr);
    });
  }

  carregarBtn.addEventListener('click', carregarTabela);

  // Export Excel
  exportXLSbtn.addEventListener('click', () => {
    const table = document.getElementById('pautaTable');
    if (table.querySelectorAll('tbody tr').length === 0) {
      alert('Não há dados para exportar.');
      return;
    }
    const wb = XLSX.utils.table_to_book(table, {sheet: "Pauta"});
    XLSX.writeFile(wb, "pauta.xlsx");
  });

  // Export PDF
  exportPDFbtn.addEventListener('click', () => {
    const rows = Array.from(tbody.querySelectorAll('tr'));
    if (!rows.length) { alert('Não há dados para exportar.'); return; }

    const body = rows.map(tr => Array.from(tr.children).map(td => td.textContent));
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({unit:'pt', format:'a4'});
    doc.setFontSize(12);
    doc.text('Pauta - Export', 40, 40);
    doc.autoTable({
      startY: 60,
      head: [['#','Nome','Nota 1','Nota 2','Nota 3','Final']],
      body: body,
      styles: { fontSize: 10, cellPadding: 6 },
      theme: 'striped',
      headStyles: { fillColor: [39,174,96] }
    });
    doc.save('pauta.pdf');
  });

  // Filtro global
  globalSearch.addEventListener('input', (e) => {
    const q = (e.target.value || '').toLowerCase().trim();
    Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
      const nome = tr.children[1].textContent.toLowerCase();
      tr.style.display = nome.includes(q) ? '' : 'none';
    });
  });
})();
