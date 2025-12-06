// lancar_notas.js (corrigido para 3 notas)
(() => {
  const alunosPorTurma = {
    "10A":[{id:"A001",nome:"Ana Silva",foto:""},{id:"A002",nome:"João Pedro",foto:""},{id:"A003",nome:"Maria Lopes",foto:""}],
    "10B":[{id:"B001",nome:"Carlos Pinto",foto:""},{id:"B002",nome:"Sara Costa",foto:""},{id:"B003",nome:"Miguel Santos",foto:""}],
    "11A":[{id:"C001",nome:"Lúcia Marques",foto:""},{id:"C002",nome:"Pedro Alves",foto:""}]
  };

  const carregarBtn = document.getElementById('carregarAlunos');
  const tbody = document.querySelector('#notasTable tbody');
  const selectTurma = document.getElementById('selectTurma');
  const selectDisc = document.getElementById('selectDisc');
  const selectCurso = document.getElementById('selectCurso');
  const salvarBtn = document.getElementById('salvarNotas');
  const exportPDFbtn = document.getElementById('exportPDF');
  const exportXLSbtn = document.getElementById('exportXLS');
  const globalSearch = document.getElementById('globalSearch');

  function placeholderImg(name){
    const initials = (name.split(' ').map(n=>n[0]).slice(0,2).join('')||'U').toUpperCase();
    const svg = `<svg xmlns='http://www.w3.org/2000/svg' width='120' height='120'><rect width='100%' height='100%' fill='#e6f4ea'/><text x='50%' y='50%' font-size='48' dominant-baseline='middle' text-anchor='middle' fill='#27ae60' font-family='Segoe UI, Arial'>${initials}</text></svg>`;
    return 'data:image/svg+xml;base64,'+btoa(svg);
  }

  function computeFinal(n1,n2,n3){
    const vals=[];
    [n1,n2,n3].forEach(x=>{
      const v=parseFloat(x);
      if(!isNaN(v)) vals.push(v);
    });
    if(!vals.length) return '';
    const avg=vals.reduce((s,x)=>s+x,0)/vals.length;
    return avg.toFixed(1);
  }

  carregarBtn.addEventListener('click', ()=>{
    const turma=selectTurma.value;
    const disc=selectDisc.value;
    const curso=selectCurso.value;

    tbody.innerHTML='';
    if(!turma||!disc||!curso){ alert('Seleciona Curso, Turma e Disciplina antes de carregar.'); return; }

    const alunos=alunosPorTurma[turma]||[];
    if(!alunos.length){
      tbody.innerHTML=`<tr><td colspan="8" style="color:#6b7a8c;padding:12px">Nenhum aluno encontrado nesta turma.</td></tr>`;
      return;
    }

    const savedKey=`notas_${curso}_${turma}_${disc}`;
    const saved=JSON.parse(localStorage.getItem(savedKey)||'null');

    alunos.forEach((a,idx)=>{
      const nota1Val = saved && saved[idx] ? saved[idx].nota1 : '';
      const nota2Val = saved && saved[idx] ? saved[idx].nota2 : '';
      const nota3Val = saved && saved[idx] ? saved[idx].nota3 : '';
      const finalVal = computeFinal(nota1Val,nota2Val,nota3Val);

      const tr=document.createElement('tr');
      tr.dataset.index=idx;
      tr.innerHTML=`
        <td>${idx+1}</td>
        <td><img class="student-pic" src="${a.foto||placeholderImg(a.nome)}" alt="${a.nome}"></td>
        <td>${a.nome}</td>
        <td><input class="nota nota1" type="number" min="0" max="20" step="0.1" value="${nota1Val}"></td>
        <td><input class="nota nota2" type="number" min="0" max="20" step="0.1" value="${nota2Val}"></td>
        <td><input class="nota nota3" type="number" min="0" max="20" step="0.1" value="${nota3Val}"></td>
        <td class="notaFinal">${finalVal===''?'-':finalVal}</td>
        <td class="actions-cell"><button class="btn-edit" title="Limpar"><i class="fas fa-eraser"></i></button></td>
      `;
      tbody.appendChild(tr);
    });
  });

  document.addEventListener('input',(e)=>{
    if(e.target.classList.contains('nota1')||e.target.classList.contains('nota2')||e.target.classList.contains('nota3')){
      const tr=e.target.closest('tr');
      const n1=tr.querySelector('.nota1').value;
      const n2=tr.querySelector('.nota2').value;
      const n3=tr.querySelector('.nota3').value;
      tr.querySelector('.notaFinal').textContent=computeFinal(n1,n2,n3)||'-';
    }
  });

  document.addEventListener('click',(e)=>{
    if(e.target.closest('.btn-edit')){
      const tr=e.target.closest('tr');
      tr.querySelector('.nota1').value='';
      tr.querySelector('.nota2').value='';
      tr.querySelector('.nota3').value='';
      tr.querySelector('.notaFinal').textContent='-';
    }
  });

  salvarBtn.addEventListener('click',()=>{
    const turma=selectTurma.value;
    const disc=selectDisc.value;
    const curso=selectCurso.value;
    if(!turma||!disc||!curso){ alert('Seleciona Curso, Turma e Disciplina antes de salvar.'); return; }

    const key=`notas_${curso}_${turma}_${disc}`;
    const rows=Array.from(document.querySelectorAll('#notasTable tbody tr'));
    const data=rows.map(tr=>({
      aluno: tr.children[2].textContent.trim(),
      nota1: tr.querySelector('.nota1')?.value||'',
      nota2: tr.querySelector('.nota2')?.value||'',
      nota3: tr.querySelector('.nota3')?.value||'',
      final: tr.querySelector('.notaFinal').textContent.trim()
    }));
    localStorage.setItem(key,JSON.stringify(data));
    alert('Notas salvas com sucesso.');
  });

  exportXLSbtn.addEventListener('click',()=>{
    const table=document.getElementById('notasTable');
    if(!table.querySelectorAll('tbody tr').length){ alert('Não há dados para exportar.'); return; }
    const wb=XLSX.utils.table_to_book(table,{sheet:"Notas"});
    XLSX.writeFile(wb,"notas.xlsx");
  });

  exportPDFbtn.addEventListener('click',()=>{
    const rows=Array.from(document.querySelectorAll('#notasTable tbody tr'));
    if(!rows.length){ alert('Não há dados para exportar.'); return; }

    const head=Array.from(document.querySelectorAll('#notasTable thead th')).map(th=>th.innerText);
    const body=rows.map(tr=>[
      tr.children[0].innerText.trim(),
      tr.children[2].innerText.trim(),
      tr.querySelector('.nota1')?.value||'',
      tr.querySelector('.nota2')?.value||'',
      tr.querySelector('.nota3')?.value||'',
      tr.querySelector('.notaFinal').innerText.trim()
    ]);

    const { jsPDF } = window.jspdf;
    const doc=new jsPDF({unit:'pt',format:'a4'});
    doc.setFontSize(12);
    doc.text('Notas - Export',40,40);
    doc.autoTable({
      startY:60,
      head:[['#','Nome','Nota 1','Nota 2','Nota 3','Final']],
      body:body,
      styles:{fontSize:10,cellPadding:6},
      theme:'striped',
      headStyles:{fillColor:[39,174,96]}
    });
    doc.save('notas.pdf');
  });

  globalSearch.addEventListener('input',(e)=>{
    const q=(e.target.value||'').toLowerCase().trim();
    document.querySelectorAll('#notasTable tbody tr').forEach(tr=>{
      const name=tr.children[2].textContent.toLowerCase();
      tr.style.display=!q||name.includes(q)?'':'none';
    });
  });
})();
