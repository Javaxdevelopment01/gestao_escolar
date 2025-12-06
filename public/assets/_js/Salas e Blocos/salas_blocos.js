(() => {
  const salasPorBloco = {
    "Bloco 1": [
      { nome: "Sala 101", capacidade: 30 },
      { nome: "Sala 102", capacidade: 25 },
      { nome: "Sala 103", capacidade: 28 },
      { nome: "Sala 104", capacidade: 30 },
      { nome: "Sala 105", capacidade: 32 },
      { nome: "Sala 106", capacidade: 27 },
      { nome: "Sala 107", capacidade: 29 },
    ],
    "Bloco 2": [
      { nome: "Sala 201", capacidade: 30 },
      { nome: "Sala 202", capacidade: 28 },
      { nome: "Sala 203", capacidade: 26 },
      { nome: "Sala 204", capacidade: 32 },
      { nome: "Sala 205", capacidade: 25 },
    ]
  };

  const selectBloco = document.getElementById('selectBloco');
  const tbody = document.querySelector('#salasTable tbody');
  const carregarBtn = document.getElementById('carregarSalas');
  const globalSearch = document.getElementById('globalSearch');
  const exportPDFbtn = document.getElementById('exportPDF');
  const exportXLSbtn = document.getElementById('exportXLS');

  function carregarSalas() {
    const bloco = selectBloco.value;
    tbody.innerHTML = '';
    if (!bloco) { alert('Seleciona um bloco antes de carregar.'); return; }

    const salas = salasPorBloco[bloco] || [];
    if (!salas.length) {
      tbody.innerHTML = `<tr><td colspan="4" style="color:#6b7a8c;padding:12px">Nenhuma sala encontrada neste bloco.</td></tr>`;
      return;
    }

    salas.forEach((s, idx) => {
      const tr = document.createElement('tr');
      tr.dataset.index = idx;
      tr.innerHTML = `
        <td>${idx+1}</td>
        <td>${s.nome}</td>
        <td>${bloco}</td>
        <td>${s.capacidade}</td>
      `;
      tbody.appendChild(tr);
    });
  }

  carregarBtn.addEventListener('click', carregarSalas);

  // Pesquisa global
  globalSearch.addEventListener('input', (e) => {
    const q = (e.target.value || '').toLowerCase().trim();
    document.querySelectorAll('#salasTable tbody tr').forEach(tr => {
      const nomeSala = tr.children[1].textContent.toLowerCase();
      const bloco = tr.children[2].textContent.toLowerCase();
      const match = !q || nomeSala.includes(q) || bloco.includes(q);
      tr.style.display = match ? '' : 'none';
    });
  });

  // Export XLS
  exportXLSbtn.addEventListener('click', () => {
    const table = document.getElementById('salasTable');
    if (table.querySelectorAll('tbody tr').length === 0) {
      alert('Não há dados para exportar.');
      return;
    }
    const wb = XLSX.utils.table_to_book(table, {sheet:"Salas"});
    XLSX.writeFile(wb, "salas.xlsx");
  });

  // Export PDF
  exportPDFbtn.addEventListener('click', () => {
    const rows = Array.from(document.querySelectorAll('#salasTable tbody tr'));
    if (rows.length === 0) { alert('Não há dados para exportar.'); return; }

    const body = rows.map(tr => [
      tr.children[0].innerText,
      tr.children[1].innerText,
      tr.children[2].innerText,
      tr.children[3].innerText
    ]);

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({unit:'pt', format:'a4'});
    doc.setFontSize(12);
    doc.text('Salas & Blocos', 40, 40);
    doc.autoTable({
      startY: 60,
      head: [['#', 'Nome da Sala', 'Bloco', 'Capacidade']],
      body: body,
      styles: { fontSize: 10, cellPadding: 6 },
      theme: 'striped',
      headStyles: { fillColor: [39,174,96] }
    });
    doc.save('salas_blocos.pdf');
  });

})();

// ================= Modal Adicionar Sala
const modal = document.getElementById('modalAddSala');
const btnOpenModal = document.createElement('button');
btnOpenModal.classList.add('btn-add');
btnOpenModal.textContent = "Adicionar Nova Sala";
btnOpenModal.style.marginBottom = "15px";
document.querySelector('.filters').appendChild(btnOpenModal);

const closeModal = modal.querySelector('.close-modal');
const formAddSala = document.getElementById('formAddSala');

btnOpenModal.addEventListener('click', () => modal.style.display = 'flex');
closeModal.addEventListener('click', () => modal.style.display = 'none');
window.addEventListener('click', e => { if(e.target === modal) modal.style.display='none'; });

// Salvar nova sala dinamicamente
formAddSala.addEventListener('submit', e => {
  e.preventDefault();
  const nome = document.getElementById('inputSala').value.trim();
  const bloco = document.getElementById('selectBlocoModal').value;
  const capacidade = parseInt(document.getElementById('inputCapacidade').value);

  if(!nome || !bloco || !capacidade) return alert('Preenche todos os campos');

  // Atualizar objeto de salas
  if(!salasPorBloco[bloco]) salasPorBloco[bloco] = [];
  salasPorBloco[bloco].push({nome, capacidade});

  // Se o bloco selecionado no filtro for o mesmo, adicionar na tabela
  if(selectBloco.value === bloco) carregarSalas();

  modal.style.display = 'none';
  formAddSala.reset();
  alert('Sala adicionada com sucesso!');
});
