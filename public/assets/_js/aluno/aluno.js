document.addEventListener('DOMContentLoaded', () => {

    const modal = document.getElementById('modal');
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const alunoForm = document.getElementById('alunoForm');
    const alunosTable = document.getElementById('alunosTable');

    // Abrir modal
    openModal.addEventListener('click', () => modal.style.display = 'block');

    // Fechar modal
    closeModal.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', e => {
        if(e.target === modal) modal.style.display = 'none';
    });

    // Adicionar aluno (mesmo código anterior)
  /*  alunoForm.addEventListener('submit', e => {
        e.preventDefault();
        const nome = document.getElementById('nome').value.trim();
        const turma = document.getElementById('turma').value.trim();
        const sala = document.getElementById('sala').value.trim();
        const curso = document.getElementById('curso').value.trim();
        const fotoInput = document.getElementById('foto');

        if(!nome || !turma || !sala || !curso) {
            alert('Por favor, preencha todos os campos!');
            return;
        }

        const reader = new FileReader();
        reader.onload = function() {
            const foto = reader.result || 'https://via.placeholder.com/40';
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><img src="${foto}" alt="${nome}"></td>
                <td>${nome}</td>
                <td>${turma}</td>
                <td>${sala}</td>
                <td>${curso}</td>
                <td>
                    <button class="btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" title="Excluir"><i class="fas fa-trash"></i></button>
                </td>
            `;
            alunosTable.appendChild(tr);
            alunoForm.reset();
            modal.style.display = 'none';
        }

        if(fotoInput.files[0]) {
            reader.readAsDataURL(fotoInput.files[0]);
        } else {
            reader.onload();
        }
    });*/

    // Deletar aluno
    /*alunosTable.addEventListener('click', e => {
        const btn = e.target.closest('.btn-delete');
        if(btn) {
            if(confirm('Tem certeza que deseja remover este aluno?')) {
                btn.closest('tr').remove();
            }
        }
    });

    // Editar aluno
    alunosTable.addEventListener('click', e => {
        const btn = e.target.closest('.btn-edit');
        if(btn) {
            const tr = btn.closest('tr');
            const tds = tr.querySelectorAll('td');
            document.getElementById('nome').value = tds[1].textContent;
            document.getElementById('turma').value = tds[2].textContent;
            document.getElementById('sala').value = tds[3].textContent;
            document.getElementById('curso').value = tds[4].textContent;
            modal.style.display = 'block';

            alunoForm.onsubmit = function(ev) {
                ev.preventDefault();
                tds[1].textContent = document.getElementById('nome').value.trim();
                tds[2].textContent = document.getElementById('turma').value.trim();
                tds[3].textContent = document.getElementById('sala').value.trim();
                tds[4].textContent = document.getElementById('curso').value.trim();
                alunoForm.reset();
                modal.style.display = 'none';
                alunoForm.onsubmit = null;
            }
        }
    });

    */
});
const input_foto_cadastro_aluno=document.getElementById("foto_aluno")
const foto_cadastro_aluno=document.getElementById("img-preview")
input_foto_cadastro_aluno.addEventListener("change", (evento) => {
    const file = evento.target.files[0]
    if (file) {
        foto_cadastro_aluno.src = URL.createObjectURL(file)//criar um url temporario para a imagems selecionada

    }

}) 

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');
    const alunoForm = document.getElementById('alunoForm');
    const alunosContainer = document.getElementById('alunosContainer');

    // Abrir modal
    openModal.addEventListener('click', () => modal.style.display = 'block');

    // Fechar modal
    closeModal.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', e => {
        if(e.target === modal) modal.style.display = 'none';
    });

    // Adicionar aluno
    /*
    alunoForm.addEventListener('submit', e => {
        e.preventDefault();

        const nome = document.getElementById('nome').value.trim();
        const turma = document.getElementById('turma').value.trim();
        const sala = document.getElementById('sala').value.trim();
        const curso = document.getElementById('curso').value.trim();
        const fotoInput = document.getElementById('foto');

        if(!nome || !turma || !sala || !curso){
            alert('Por favor, preencha todos os campos!');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(){
            const foto = reader.result || 'https://via.placeholder.com/80';
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <img src="${foto}" alt="${nome}">
                <h3>${nome}</h3>
                <p>Turma: ${turma}</p>
                <p>Sala: ${sala}</p>
                <p>Curso: ${curso}</p>
                <div class="card-actions">
                    <button class="btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-delete" title="Excluir"><i class="fas fa-trash"></i></button>
                </div>
            `;
            alunosContainer.appendChild(card);
            alunoForm.reset();
            modal.style.display = 'none';
        }

        if(fotoInput.files[0]){
            reader.readAsDataURL(fotoInput.files[0]);
        } else {
            reader.onload();
        }
    });

    // Editar e deletar
    alunosContainer.addEventListener('click', e => {
        const card = e.target.closest('.card');
        if(!card) return;

        // Deletar
        if(e.target.closest('.btn-delete')){
            if(confirm('Tem certeza que deseja remover este aluno?')){
                card.remove();
            }
        }

        // Editar
        if(e.target.closest('.btn-edit')){
            const nome = card.querySelector('h3').textContent;
            const turma = card.querySelector('p:nth-of-type(1)').textContent.replace('Turma: ','');
            const sala = card.querySelector('p:nth-of-type(2)').textContent.replace('Sala: ','');
            const curso = card.querySelector('p:nth-of-type(3)').textContent.replace('Curso: ','');
            
            document.getElementById('nome').value = nome;
            document.getElementById('turma').value = turma;
            document.getElementById('sala').value = sala;
            document.getElementById('curso').value = curso;
            modal.style.display = 'block';

            alunoForm.onsubmit = function(ev){
                ev.preventDefault();
                card.querySelector('h3').textContent = document.getElementById('nome').value.trim();
                card.querySelector('p:nth-of-type(1)').textContent = `Turma: ${document.getElementById('turma').value.trim()}`;
                card.querySelector('p:nth-of-type(2)').textContent = `Sala: ${document.getElementById('sala').value.trim()}`;
                card.querySelector('p:nth-of-type(3)').textContent = `Curso: ${document.getElementById('curso').value.trim()}`;
                alunoForm.reset();
                modal.style.display = 'none';
                alunoForm.onsubmit = null;
            }
        }
    });
    */
});

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase();
    const cards = alunosContainer.querySelectorAll('.card');

    cards.forEach(card => {
        const nome = card.querySelector('h3').textContent.toLowerCase();
        const turma = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
        const sala = card.querySelector('p:nth-of-type(2)').textContent.toLowerCase();
        const curso = card.querySelector('p:nth-of-type(3)').textContent.toLowerCase();

        if(nome.includes(query) || turma.includes(query) || sala.includes(query) || curso.includes(query)){
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
