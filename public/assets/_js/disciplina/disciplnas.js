// disciplinas.js
document.addEventListener('DOMContentLoaded', () => {
  // seletores — tentativa de compatibilidade com vários nomes de botões/ids
  const openModalBtn = document.getElementById('openModal') ||
                       document.getElementById('btnNovaDisciplina') ||
                       document.getElementById('btnAdicionar');

  const modal = document.getElementById('modal') || document.getElementById('modalDisciplina');
  const closeModalBtn = document.getElementById('closeModal') || (modal ? modal.querySelector('.close') : null);

  // container de cards (preferido) ou tbody fallback
  const disciplinasContainer = document.getElementById('disciplinasContainer');
  const disciplinasTableBody = document.getElementById('listaDisciplinas');

  // formulário e inputs (compatível com nomes comuns)
  const form = document.getElementById('disciplinaForm') || document.getElementById('formDisciplina');
  const inputNome = document.getElementById('nomeDisciplina') || document.getElementById('nome');
  const inputCarga = document.getElementById('cargaHoraria') || document.getElementById('carga');
  const inputProfessor = document.getElementById('professorResponsavel') || document.getElementById('professor');

  const searchInput = document.getElementById('searchInput');

  // armazenamento local
  const STORAGE_KEY = 'sge_disciplinas_v1';
  let disciplinas = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
  let editIndex = null;

  // Abre modal (novo)
  if (openModalBtn) {
    openModalBtn.addEventListener('click', () => {
      editIndex = null;
      if (form) form.reset();
      if (modal) modal.style.display = 'flex';
      if (inputNome) inputNome.focus();
    });
  }

  // Fecha modal
  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', () => {
      if (modal) modal.style.display = 'none';
      if (form) form.reset();
      editIndex = null;
    });
  }

  // Fecha clicando fora
  window.addEventListener('click', (e) => {
    if (modal && e.target === modal) {
      modal.style.display = 'none';
      if (form) form.reset();
      editIndex = null;
    }
  });

  // Submeter form (criar / atualizar)
  /*
  if (form) {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const nome = (inputNome && inputNome.value || '').trim();
      const carga = (inputCarga && inputCarga.value || '').trim();
      const professor = (inputProfessor && inputProfessor.value || '').trim();

      if (!nome || !carga) {
        alert('Preencha pelo menos o nome da disciplina e a carga horária.');
        return;
      }

      if (editIndex !== null) {
        // atualizar
        disciplinas[editIndex] = { id: disciplinas[editIndex].id, nome, carga, professor };
        editIndex = null;
      } else {
        // criar novo
        disciplinas.push({ id: Date.now(), nome, carga, professor });
      }

      salvarERecarregar();
      if (modal) modal.style.display = 'none';
      form.reset();
    });
  }
*/
  // Render (cards ou tabela)
  function renderDisciplinas(filter = '') {
    const q = String(filter || '').toLowerCase().trim();

    const lista = disciplinas.filter(d => {
      const all = `${d.nome} ${d.carga} ${d.professor}`.toLowerCase();
      return all.includes(q);
    });

    if (disciplinasContainer) {
      // render cards
      disciplinasContainer.innerHTML = '';
      if (lista.length === 0) {
        disciplinasContainer.innerHTML = '<p class="empty-msg">Nenhuma disciplina cadastrada.</p>';
        return;
      }
      lista.forEach((d, idx) => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
          <i class="fas fa-book" aria-hidden="true"></i>
          <h3>${escapeHtml(d.nome)}</h3>
          <p><strong>Carga:</strong> ${escapeHtml(d.carga)}</p>
          <p><strong>Professor:</strong> ${escapeHtml(d.professor || '-')}</p>
          <div class="card-actions">
            <button class="btn-edit" data-index="${getIndexById(d.id)}" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn-delete" data-index="${getIndexById(d.id)}" title="Excluir"><i class="fas fa-trash"></i></button>
          </div>
        `;
        disciplinasContainer.appendChild(card);
      });
      return;
    }

    if (disciplinasTableBody) {
      // render tabela
      disciplinasTableBody.innerHTML = '';
      if (lista.length === 0) {
        disciplinasTableBody.innerHTML = '<tr><td colspan="5" style="color:#6b7a8c;padding:12px">Nenhuma disciplina cadastrada.</td></tr>';
        return;
      }
      lista.forEach((d) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${d.id}</td>
          <td>${escapeHtml(d.nome)}</td>
          <td>${escapeHtml(d.professor || '-')}</td>
          <td>${escapeHtml(d.carga)}</td>
          <td>
            <button class="btn-edit" data-index="${getIndexById(d.id)}">Editar</button>
            <button class="btn-delete" data-index="${getIndexById(d.id)}">Excluir</button>
          </td>
        `;
        disciplinasTableBody.appendChild(tr);
      });
      return;
    }

    // se nenhum container encontrado, tenta console.warn
    console.warn('Nenhum container encontrado para renderizar disciplinas. IDs esperados: "disciplinasContainer" (cards) ou "listaDisciplinas" (tabela).');
  }

  // Event delegation para editar/excluir em cards ou tabela
  document.addEventListener('click', (e) => {
    const btnEdit = e.target.closest('.btn-edit');
    const btnDelete = e.target.closest('.btn-delete');

    if (btnEdit) {
      const idx = Number(btnEdit.dataset.index);
      if (idx >= 0 && disciplinas[idx]) {
        const d = disciplinas[idx];
        if (inputNome) inputNome.value = d.nome;
        if (inputCarga) inputCarga.value = d.carga;
        if (inputProfessor) inputProfessor.value = d.professor || '';
        editIndex = idx;
        if (modal) modal.style.display = 'flex';
        if (inputNome) inputNome.focus();
      }
      return;
    }

    if (btnDelete) {
      const idx = Number(btnDelete.dataset.index);
      if (idx >= 0 && disciplinas[idx]) {
        if (confirm('Quer mesmo eliminar esta disciplina?')) {
          disciplinas.splice(idx, 1);
          salvarERecarregar();
        }
      }
      return;
    }
  });

  // pesquisa em tempo real (se existir)
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      renderDisciplinas(e.target.value);
    });
  }

  // utils
  function getIndexById(id) {
    return disciplinas.findIndex(x => x.id === id);
  }

  function salvarERecarregar() {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(disciplinas));
    renderDisciplinas(searchInput ? searchInput.value : '');
  }

  function escapeHtml(str) {
    return String(str || '')
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  // inicializa
  renderDisciplinas();
});
