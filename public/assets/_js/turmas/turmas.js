// turmas.js
document.addEventListener('DOMContentLoaded', () => {
  const openModalBtn = document.getElementById('openModal');
  const closeModalBtn = document.getElementById('closeModal');
  const modal = document.getElementById('modal');
  const turmaForm = document.getElementById('turmaForm');
  const turmasContainer = document.getElementById('turmasContainer');
  const searchInput = document.getElementById('searchInput');

  // campos do formulário
  const inputNome = document.getElementById('nomeTurma');
  const inputCurso = document.getElementById('curso');
  const inputAno = document.getElementById('ano');
  const inputSala = document.getElementById('sala');

  let turmas = [];      // lista em memória
  let editIndex = null; // índice sendo editado (null se for nova)

  // Abre modal para nova turma
  openModalBtn.addEventListener('click', () => {
    editIndex = null;
    turmaForm.reset();
    modal.style.display = 'block';
  
  });

  // Fecha modal
  closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    turmaForm.reset();
    editIndex = null;
  });

  // Fecha ao clicar fora
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
      turmaForm.reset();
      editIndex = null;
    }
  });

  // Renderizar lista (cards)
  /*
  function renderTurmas(filter = '') {
    turmasContainer.innerHTML = '';
    const q = String(filter || '').toLowerCase().trim();

    const lista = turmas.filter(t => {
      const all = `${t.turma}`.toLowerCase();
      return all.includes(q);
    });

    if (lista.length === 0) {
      turmasContainer.innerHTML = '<p style="color:#6b7a8c">Nenhuma turma encontrada.</p>';
      return;
    }

    lista.forEach((t, index) => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <i class="fas fa-users" aria-hidden="true"></i>
        <h3>${escapeHtml(t.nome)}</h3>
        <p><strong>Curso:</strong> ${escapeHtml(t.curso)}</p>
        <p><strong>Ano:</strong> ${escapeHtml(t.ano)}</p>
        <p><strong>Sala:</strong> ${escapeHtml(t.sala)}</p>
        <div class="card-actions">
          <button class="btn-edit" data-index="${getIndexById(t.id)}" title="Editar"><i class="fas fa-edit"></i></button>
          <button class="btn-delete" data-index="${getIndexById(t.id)}" title="Excluir"><i class="fas fa-trash"></i></button>
        </div>
      `;
      turmasContainer.appendChild(card);
    });
  }
*/
  // Ajuda: encontra o índice actual pela id
  function getIndexById(id) {
    return turmas.findIndex(x => x.id === id);
  }

  // Event delegation para ações nos cards
  turmasContainer.addEventListener('click', (e) => {
    const btnEdit = e.target.closest('.btn-edit');
    const btnDelete = e.target.closest('.btn-delete');

    if (btnEdit) {
      const idx = Number(btnEdit.dataset.index);
      if (idx >= 0 && turmas[idx]) {
        const t = turmas[idx];
        inputNome.value = t.nome;
        inputCurso.value = t.curso;
        inputAno.value = t.ano;
        inputSala.value = t.sala;
        editIndex = idx;
        modal.style.display = 'block';
        inputNome.focus();
      }
      return;
    }

    if (btnDelete) {
      const idx = Number(btnDelete.dataset.index);
      if (idx >= 0 && turmas[idx]) {
        if (confirm('Tem a certeza que deseja eliminar esta turma?')) {
          turmas.splice(idx, 1);
          renderTurmas(searchInput ? searchInput.value : '');
        }
      }
      return;
    }
  });

  // Pesquisa em tempo real (se existir o input)
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      renderTurmas(e.target.value);
    });
  }

  // Util: escape para evitar inserir HTML arbitrário
  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  // Inicializa com nada (ou se quiseres, podes pré-carregar exemplos)
  renderTurmas();
});

