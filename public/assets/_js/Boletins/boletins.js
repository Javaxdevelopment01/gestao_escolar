// boletins.js

(() => {
  // exemplo de alunos com notas para cada curso/turma/disciplina
  const alunosData = {
    "Curso1": {
      "10A": {
        "Matematica": [
          {nome: "Ana Silva", nota1: 15, nota2: 17, nota3: 16},
          {nome: "João Pedro", nota1: 12, nota2: 14, nota3: 13},
        ],
        "Fisica": [
          {nome: "Ana Silva", nota1: 14, nota2: 15, nota3: 16},
          {nome: "João Pedro", nota1: 13, nota2: 12, nota3: 14},
        ]
      },
      "10B": {
        "Matematica": [
          {nome: "Carlos Pinto", nota1: 10, nota2: 12, nota3: 14},
          {nome: "Sara Costa", nota1: 16, nota2: 17, nota3: 18},
        ]
      }
    },
    "Curso2": {
      "11A": {
        "TLP": [
          {nome: "Lúcia Marques", nota1: 18, nota2: 19, nota3: 17},
          {nome: "Pedro Alves", nota1: 15, nota2: 14, nota3: 16},
        ]
      }
    },
    "Curso3": {
      "11B": {
        "SEAC": [
          {nome: "Miguel Santos", nota1: 12, nota2: 13, nota3: 14}
        ]
      }
    }
  };

  const selectCurso = document.getElementById('selectCurso');
  const selectTurma = document.getElementById('selectTurma');
  const selectDisc = document.getElementById('selectDisc');
  const carregarBtn = document.getElementById('carregarBoletins');
  const tbody = document.querySelector('#boletinsTable tbody');
  const exportPDFbtn = document.getElementById('exportPDF');
  const exportXLSbtn = document.getElementById('exportXLS');
  const globalSearch = document.getElementById('globalSearch');

  function calcularFinal(n1, n2, n3) {
    const vals = [parseFloat(n1), parseFloat(n2), parseFloat(n3)].filter(x => !isNaN(x));
    if (!vals.length) return '-';
    const soma = vals.reduce((a,b)=>a+b,0);
    return (soma / vals.length).toFixed(1);
  }

  carregarBtn.addEventListener('click', () => {
    const curso = selectCurso.value;
    const turma = selectTurma.value;
    const disc = selectDisc.value;

    tbody.innerHTML = '';
    if (!curso || !turma || !disc) {
      alert('Seleciona Curso, Turma e Disciplina.');
      return;
    }

    const alunos = (alunosData[curso] && alunosData[curso][turma] && alunosData[curso][turma][disc]) || [];
    if (!alunos.length) {
      tbody.innerHTML = `<tr><td colspan="9" style="color:#6b7a8c;padding:12px">Nenhum aluno encontrado.</td></tr>`;
      return;
    }

    alunos.forEach((aluno, idx) => {
      const final = calcularFinal(aluno.nota1, aluno.nota2, aluno.nota3);
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${idx+1}</td>
        <td>${aluno.nome}</td>
        <td>${curso}</td>
        <td>${turma}</td>
        <td>${disc}</td>
        <td>${aluno.nota1}</td>
        <td>${aluno.nota2}</td>
        <td>${aluno.nota3}</td>
        <td>${final}</td>
      `;
      tbody.appendChild(tr);
    });
  });

  globalSearch.addEventListener('input', e => {
    const q = e.target.value.toLowerCase().trim();
    document.querySelectorAll('#boletinsTable tbody tr').forEach(tr => {
      const name = tr.children[1].textContent.toLowerCase();
      const match = !q || name.includes(q);
      tr.style.display = match ? '' : 'none';
    });
  });

  // export PDF
  exportPDFbtn.addEventListener('click', () => {
    const rows = Array.from(document.querySelectorAll('#boletinsTable tbody tr'));
    if (!rows.length) { alert('Nenhum dado para exportar.'); return; }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({unit:'pt', format:'a4'});
    doc.setFontSize(12);
    doc.text('Boletins - Export', 40, 40);

    const body = rows.map(tr => Array.from(tr.children).map(td => td.innerText));
    doc.autoTable({
      startY: 60,
      head: [['#','Aluno','Curso','Turma','Disciplina','Nota 1','Nota 2','Nota 3','Final']],
      body: body,
      styles: { fontSize: 10, cellPadding: 6 },
      theme: 'striped',
      headStyles: { fillColor: [39,174,96] }
    });
    doc.save('boletins.pdf');
  });

  // export XLS
  exportXLSbtn.addEventListener('click', () => {
    const table = document.getElementById('boletinsTable');
    if (!table.querySelectorAll('tbody tr').length) {
      alert('Nenhum dado para exportar.');
      return;
    }
    const wb = XLSX.utils.table_to_book(table, {sheet:"Boletins"});
    XLSX.writeFile(wb, "boletins.xlsx");
  });

})();
