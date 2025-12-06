<?php
require_once "../../../assets/_includes/header.php";
?>
<title>Horários - Gestão Escolar</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
/* =======================
   CSS seguindo teu padrão (verde, sidebar, topbar, cards, modal)
   ======================= */
*{box-sizing:border-box;margin:0;padding:0;font-family:'Segoe UI',sans-serif}
html,body{height:100%}
body{display:flex;background:#f4f7fa;color:#2c3e50}

/* Sidebar (igual padrão) */
.sidebar{
  width:250px;background:linear-gradient(180deg,#27ae60,#2ecc71);
  color:#fff;display:flex;flex-direction:column;padding:18px 0; height:100vh; position:fixed; overflow-y:auto;
}
.sidebar-logo{display:flex;align-items:center;gap:10px;padding:0 18px 14px}
.sidebar-logo img{width:54px;height:54px;object-fit:contain}
.sidebar-logo h2{font-size:18px;font-weight:700}
.sidebar-nav{display:flex;flex-direction:column;padding-bottom:30px}
.sidebar-nav a{display:flex;align-items:center;gap:12px;padding:11px 18px;color:#fff;text-decoration:none;border-left:3px solid transparent;transition:background .2s,padding-left .2s,border-color .2s}
.sidebar-nav a i{font-size:16px}
.sidebar-nav a:hover{background:rgba(0,0,0,.15);padding-left:22px}
.sidebar-nav a.active{background:rgba(0,0,0,.25);border-left-color:#fff}
.menu-title{font-size:11px;letter-spacing:.6px;text-transform:uppercase;opacity:.85;padding:10px 18px 6px}
/* nice scrollbar */
.sidebar::-webkit-scrollbar{width:8px}
.sidebar::-webkit-scrollbar-thumb{background:rgba(0,0,0,.28);border-radius:8px}

/* Main content and topbar */
.main-content{flex:1;margin-left:250px;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:#fff;padding:14px 20px;display:none;align-items:center;justify-content:space-between;border-bottom:1px solid #e6ecf1;position:sticky;top:0;z-index:10}
.search-box{display:flex;align-items:center;gap:8px;background:#f1f3f5;border-radius:10px;padding:8px 12px;min-width:280px;max-width:420px}
.search-box input{border:none;outline:none;background:transparent;font-size:14px;width:100%}
.topbar-icons{display:flex;align-items:center;gap:18px;color:#34495e}
.user-pic{width:34px;height:34px;border-radius:50%}

/* Content */
.content{padding:24px}
.content h1{font-size:26px;margin-bottom:12px}
.controls{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:18px;align-items:center}
.btn{background:#27ae60;color:#fff;border:none;padding:10px 14px;border-radius:10px;cursor:pointer;font-weight:600;box-shadow:0 6px 14px rgba(39,174,96,.12);transition:transform .08s}
.btn:hover{background:#2ecc71}
.btn.secondary{background:#1f7ae0}
.small{padding:8px 10px;border-radius:8px;font-size:14px}
.label{font-weight:600;color:#34495e;margin-right:6px}

/* Layout grid: left = controls + summary, right = calendar */
.layout{display:grid;grid-template-columns:340px 1fr;gap:18px;align-items:start}
.panel{background:#fff;border-radius:12px;padding:16px;box-shadow:0 10px 30px rgba(15,23,42,.06)}
.summary .item{display:flex;justify-content:space-between;padding:10px 6px;border-bottom:1px dashed #eef2f6}
.summary .item:last-child{border-bottom:none}
.small-muted{font-size:13px;color:#6b7a8c}
.scheduleArea{
  background-color: red;
}
/* calendar visual */
.schedule-wrap{overflow:auto}
.schedule-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:6px}
.grid-day{background:#fff;border-radius:8px;padding:8px;min-height:120px;box-shadow:0 6px 18px rgba(0,0,0,0.04)}
.grid-day h4{font-size:14px;margin-bottom:6px;color:#2c3e50}
.slot{background:#f7faf8;border-radius:6px;padding:6px;margin:6px 0;font-size:13px;color:#233;box-shadow:inset 0 -1px 0 rgba(0,0,0,0.02)}
.slot .meta{font-size:12px;color:#456;margin-top:4px}
.room-toggle{display:flex;gap:6px;flex-wrap:wrap;margin-top:8px}

/* table view for a single room */
.room-grid{overflow:auto;background:#fff;border-radius:8px;padding:12px;box-shadow:0 10px 30px rgba(0,0,0,0.04)}
.room-grid table{width:100%;border-collapse:collapse}
.room-grid th, .room-grid td{border:1px solid #eef2f6;padding:8px;text-align:center}
.room-grid th{background:#f7f9fb}

/* responsive */
@media(max-width:1000px){
  .layout{grid-template-columns:1fr; margin-bottom:12px}
  .main-content{margin-left:0}
  .sidebar{position:fixed;z-index:1200}
}
</style>

<?php
require_once "../../../assets/_includes/menu.php";
?>


  <main class="main-content">
    <header class="topbar">
      <div class="search-box">
        <input id="globalSearch" placeholder="Pesquisar (professor/curso/disciplina)..." />
        <i class="fas fa-search"></i>
      </div>
      <div class="topbar-icons">
        <i class="fas fa-bell"></i>
        <i class="fas fa-envelope"></i>
        <img src="../SGE/public/assets/_images/logo_ipm2.png" alt="User" class="user-pic" onerror="this.style.display='none'">
      </div>
    </header>

    <section class="content">
      <h1>Horários Automáticos</h1>

      <div class="controls">
        <button class="btn" id="btnGenerate"><i class="fas fa-cogs"></i> Gerar Horário</button>
        <button class="btn" id="btnExportCSV"><i class="fas fa-file-csv"></i> Exportar CSV/Excel</button>
        <button class="btn" id="btnPrint"><i class="fas fa-file-pdf"></i> Exportar / Imprimir (PDF)</button>
        <div style="margin-left:auto" class="small-muted">Dias: Seg-Sex • Tempos/dia: 6 • Salas: 12</div>
      </div>

      <div class="layout">
        <div class="panel summary">
          <h3>Resumo</h3>
          <div class="item"><div>Professores</div><div id="countProf">0</div></div>
          <div class="item"><div>Cursos</div><div id="countCourses">0</div></div>
          <div class="item"><div>Disciplinas</div><div id="countDisc">0</div></div>
          <div class="item"><div>Salas</div><div id="countRooms">12</div></div>

          <hr style="margin:10px 0">
          <div style="font-size:13px;color:#6b7a8c">Filtros</div>
          <div style="margin-top:8px">
            <label class="label">Sala</label>
            <select id="selectRoom">
              <!-- rooms populated by JS -->
            </select>
          </div>
          <div style="margin-top:8px">
            <label class="label">Ver</label>
            <select id="viewMode">
              <option value="room">Por Sala (Grade)</option>
              <option value="cards">Cards por Disciplina</option>
              <option value="prof">Por Professor</option>
            </select>
          </div>
        </div>

        <div class="panel schedule-wrap">
          <div id="scheduleArea">
            <!-- schedule will be rendered here -->
            <div style="padding:12px;color:#6b7a8c">Clique em "Gerar Horário" para começar.</div>
          </div>
        </div>
      </div>
    </section>
  </main>

<script>
/* =========================
   LOGICA DE GERAÇÃO DE HORÁRIOS
   Resumo das decisões:
   - 5 dias (Seg-Sex), 6 tempos por dia (1..6)
   - 12 salas (room_1...room_12)
   - Dados de exemplo (4 cursos, cada um com disciplinas e tempos por semana)
   - 30 professores (cada um qualificado para algumas disciplinas)
   - Cada professor: 1 dia off, max 24 tempos/semana, até 2 tempos consecutivos na mesma sala
   - Solução por backtracking com heurística.
   ========================= */

(() => {
  // Parâmetros
  const DAYS = ['Seg','Ter','Qua','Qui','Sex'];
  const PERIODS_PER_DAY = 6;
  const ROOMS = Array.from({length:12},(_,i)=>`Sala ${i+1}`);

  // Exemplo de cursos e disciplinas (cada disciplina tem 'hoursPerWeek' por curso)
  // Podes editar estes dados conforme precisares.
  const COURSES = [
    { id:'C1', name:'Curso A', disciplines: [
        {code:'MAT', name:'Matemática', hours:4},
        {code:'FIS', name:'Física', hours:3},
        {code:'INF', name:'Informática', hours:5},
        {code:'POR', name:'Português', hours:3},
    ]},
    { id:'C2', name:'Curso B', disciplines: [
        {code:'MAT', name:'Matemática', hours:4},
        {code:'QUI', name:'Química', hours:3},
        {code:'BIO', name:'Biologia', hours:3},
        {code:'INF', name:'Informática', hours:4},
    ]},
    { id:'C3', name:'Curso C', disciplines: [
        {code:'MAT', name:'Matemática', hours:4},
        {code:'HIS', name:'História', hours:2},
        {code:'POR', name:'Português', hours:3},
        {code:'ART', name:'Artes', hours:2},
    ]},
    { id:'C4', name:'Curso D', disciplines: [
        {code:'MAT', name:'Matemática', hours:4},
        {code:'INF', name:'Informática', hours:4},
        {code:'POR', name:'Português', hours:3},
        {code:'EDU', name:'Educação Física', hours:2},
    ]}
  ];

  // Cria lista de disciplinas por curso (lessons) -> cada required hour vira 1 "lesson" a agendar
  function buildLessonsFromCourses(courses){
    const lessons = [];
    courses.forEach(course=>{
      course.disciplines.forEach(d=>{
        // criar tantas entradas quantos hours
        for(let i=0;i<d.hours;i++){
          lessons.push({
            id: `${course.id}_${d.code}_${i+1}_${Date.now().toString().slice(-4)}`,
            courseId: course.id,
            courseName: course.name,
            discCode: d.code,
            discName: d.name
          });
        }
      });
    });
    return lessons;
  }

  // Professores (exemplo automático) — cada professor tem lista de disciplinas que pode lecionar.
  // Também cada professor tem um dia off (0..4).
  function createSampleProfessors(n=30, courses=COURSES){
    const allDiscCodes = Array.from(new Set(courses.flatMap(c=>c.disciplines.map(d=>d.code))));
    const profs = [];
    for(let i=0;i<n;i++){
      // dar a cada professor 3-6 disciplinas aleatórias
      const shuffled = allDiscCodes.slice().sort(()=>Math.random()-0.5);
      const count = 3 + Math.floor(Math.random()*4);
      const canTeach = shuffled.slice(0,count);
      profs.push({
        id: `P${i+1}`,
        name: `Prof ${i+1}`,
        canTeach,
        dayOff: Math.floor(Math.random()*DAYS.length),
        maxWeekly: 24,
        assignedCount:0
      });
    }
    return profs;
  }

  // Dados iniciais
  let lessons = buildLessonsFromCourses(COURSES); // array of lesson objects to schedule
  let professors = createSampleProfessors(30, COURSES);
  let schedule = {}; // map key = day-period-room -> assignment {lesson, profId}

  // helper: slot key
  function slotKey(dayIdx, periodIdx, roomIdx){
    return `${dayIdx}-${periodIdx}-${roomIdx}`;
  }

  // all slots list
  const SLOTS = [];
  for(let d=0; d<DAYS.length; d++){
    for(let p=0; p<PERIODS_PER_DAY; p++){
      for(let r=0; r<ROOMS.length; r++){
        SLOTS.push({day:d,period:p,room:r, key: slotKey(d,p,r)});
      }
    }
  }

  // Índices rápidos para checagens
  function profTeachingAt(profId, day, period){
    // percorre schedule
    for(const sk in schedule){
      const a = schedule[sk];
      if(a && a.profId === profId && a.slot.day===day && a.slot.period===period) return true;
    }
    return false;
  }
  function roomOccupied(day,period,room){
    const key = slotKey(day,period,room);
    return !!schedule[key];
  }
  function profWeeklyCount(profId){
    return professors.find(p=>p.id===profId).assignedCount;
  }

  // consecutivos na mesma sala: verificar se atribuição geraria 3+ consecutivos
  function createsThreeConsecutive(profId, day, period, room){
    // conta blocos consecutivos ao redor
    let before = 0;
    for(let p=period-1;p>=0;p--){
      const key = slotKey(day,p,room);
      const a = schedule[key];
      if(a && a.profId===profId) before++; else break;
      if(before>=2) return true;
    }
    let after = 0;
    for(let p=period+1;p<PERIODS_PER_DAY;p++){
      const key = slotKey(day,p,room);
      const a = schedule[key];
      if(a && a.profId===profId) after++; else break;
      if(after>=2) return true;
    }
    // if before + 1 + after > 2 -> not allowed
    if(before + 1 + after > 2) return true;
    return false;
  }

  // heurística: para cada lesson, precompute candidate professors (canTeach) to speed
  function candidateProfessorsForLesson(lesson){
    return professors.filter(p => p.canTeach.includes(lesson.discCode));
  }

  // Algoritmo de atribuição: backtracking com heurística (MRV-like)
  // Vamos ordenar lessons por número de candidatos (professores) ascendente, e tentar atribuir slots também com heurística (prefer fewer options)
  function solveSchedule(timeoutMs = 15000){
    // reset schedule and assignments
    schedule = {};
    professors.forEach(p => p.assignedCount = 0);

    // precompute candidates
    const lessonsList = lessons.map(l => ({
      ...l,
      candidates: candidateProfessorsForLesson(l)
    }));

    // quick fail: if any lesson has 0 candidate profs -> impossible
    const zeroCand = lessonsList.find(l=>l.candidates.length===0);
    if(zeroCand) return {ok:false, message:`Disciplina ${zeroCand.discName} sem professores qualificados (verifica dados).`};

    // order by candidates asc, then by something (like course)
    lessonsList.sort((a,b)=> a.candidates.length - b.candidates.length);

    const start = Date.now();
    // backtracking function
    function assignRecursive(idx){
      if(Date.now() - start > timeoutMs) return {ok:false, timeout:true};

      if(idx >= lessonsList.length) return {ok:true};

      const lesson = lessonsList[idx];

      // generate candidate slots list: we will try to find any (day,period,room) and prof
      // Heuristic: try days/periods in random order or sequential; better to randomize to get solution faster
      const roomIndices = Array.from({length:ROOMS.length},(_,i)=>i);
      const dayIndices = Array.from({length:DAYS.length},(_,i)=>i);
      const periodIndices = Array.from({length:PERIODS_PER_DAY},(_,i)=>i);

      // shuffle to diversify attempts
      shuffle(dayIndices); shuffle(periodIndices); shuffle(roomIndices);

      // also shuffle candidate professors order to spread load
      const profCandidates = lesson.candidates.slice().sort((a,b)=>a.assignedCount - b.assignedCount);

      for(const prof of profCandidates){
        // skip professor if at max weekly
        if(prof.assignedCount >= prof.maxWeekly) continue;
        // professor day off -> cannot assign on that day; so check day loop below

        for(const d of dayIndices){
          if(d === prof.dayOff) continue; // day off
          for(const p of periodIndices){
            // check if prof is free at that time (not teaching another room)
            if(profTeachingAt(prof.id,d,p)) continue;
            for(const r of roomIndices){
              // room free?
              if(roomOccupied(d,p,r)) continue;
              // check creates 3+ consecutive in same room for this prof
              if(createsThreeConsecutive(prof.id,d,p,r)) continue;
              // all good for this slot -> assign
              const sk = slotKey(d,p,r);
              schedule[sk] = { lesson, profId: prof.id, slot:{day:d,period:p,room:r} };
              prof.assignedCount++;
              // recursive next
              const res = assignRecursive(idx+1);
              if(res.ok) return res;
              if(res.timeout) return res;
              // backtrack
              delete schedule[sk];
              prof.assignedCount--;
            }
          }
        }
      }
      // no assignment possible for this lesson
      return {ok:false};
    }

    const result = assignRecursive(0);
    // build stats
    const assignedCount = Object.keys(schedule).length;
    return { ...result, assignedCount };
  }

  // small util shuffle
  function shuffle(arr){
    for(let i=arr.length-1;i>0;i--){
      const j = Math.floor(Math.random()*(i+1));
      [arr[i],arr[j]] = [arr[j],arr[i]];
    }
    return arr;
  }

  // render functions (UI)
  const elCountProf = document.getElementById('countProf');
  const elCountCourses = document.getElementById('countCourses');
  const elCountDisc = document.getElementById('countDisc');
  const elCountRooms = document.getElementById('countRooms');
  const selectRoom = document.getElementById('selectRoom');
  const viewMode = document.getElementById('viewMode');
  const scheduleArea = document.getElementById('scheduleArea');
  const searchInput = document.getElementById('globalSearch');

  function updateSummary(){
    elCountProf.textContent = professors.length;
    elCountCourses.textContent = COURSES.length;
    const discCount = Array.from(new Set(COURSES.flatMap(c=>c.disciplines.map(d=>d.code)))).length;
    elCountDisc.textContent = discCount;
    elCountRooms.textContent = ROOMS.length;
    // populate rooms select
    selectRoom.innerHTML = ROOMS.map((r,i)=>`<option value="${i}">${r}</option>`).join('');
  }

  function renderAll(view='room', roomIndex=0, filterQ=''){
    // filterQ lower
    const q = (filterQ||'').toLowerCase().trim();
    if(view==='cards'){
      // show disciplines as cards from schedule
      const items = Object.values(schedule).map(a=>({
        ...a,
        roomName: ROOMS[a.slot.room],
        dayName: DAYS[a.slot.day],
        period: a.slot.period+1
      })).filter(x => (x.lesson.courseName + ' ' + x.lesson.discName + ' ' + x.profId).toLowerCase().includes(q));
      if(items.length===0){
        scheduleArea.innerHTML = '<div style="padding:12px;color:#6b7a8c">Nenhuma aula atribuída (ou filtro aplicado).</div>';
        return;
      }
      scheduleArea.innerHTML = items.map(it=>`
        <div class="card" style="margin-bottom:10px;display:flex;align-items:center;gap:12px;">
          <i class="fas fa-book" style="font-size:28px;color:#27ae60"></i>
          <div style="flex:1">
            <div style="font-weight:700">${escapeHtml(it.lesson.courseName)} — ${escapeHtml(it.lesson.discName)}</div>
            <div class="small-muted">${escapeHtml(it.roomName)} • ${escapeHtml(it.dayName)} • Tempo ${it.period}</div>
          </div>
          <div style="text-align:right"><div style="font-weight:700">${escapeHtml(it.profId)}</div></div>
        </div>
      `).join('');
      return;
    }

    if(view==='prof'){
      // render per professor summary
      const perProf = {};
      Object.values(schedule).forEach(a=>{
        perProf[a.profId] = perProf[a.profId] || [];
        perProf[a.profId].push({...a, roomName: ROOMS[a.slot.room], dayName: DAYS[a.slot.day], period: a.slot.period+1});
      });
      scheduleArea.innerHTML = Object.keys(perProf).map(pid=>{
        const arr = perProf[pid].sort((a,b)=> (a.slot.day - b.slot.day) || (a.slot.period - b.slot.period));
        return `<div class="card" style="margin-bottom:8px">
          <div style="display:flex;justify-content:space-between"><strong>${escapeHtml(pid)}</strong><span>${arr.length} tempos</span></div>
          <div style="margin-top:8px">${arr.map(x=>`<div style="font-size:13px;padding:4px 0">${escapeHtml(x.lesson.courseName)} / ${escapeHtml(x.lesson.discName)} — ${escapeHtml(x.roomName)} — ${escapeHtml(x.dayName)} T${x.period}</div>`).join('')}</div>
        </div>`;
      }).join('') || '<div style="padding:12px;color:#6b7a8c">Nenhuma atribuição.</div>';
      return;
    }

    // room view (grid by day/period)
    // create matrix [days][periods] for selected room
    const tableRows = [];
    for(let p=0;p<PERIODS_PER_DAY;p++){
      const row = [ `<th>Tempo ${p+1}</th>` ];
      for(let d=0;d<DAYS.length;d++){
        // find assignment in any room? but we filter by roomIndex
        const key = slotKey(d,p,roomIndex);
        const a = schedule[key];
        if(a){
          const text = `${a.lesson.courseName} — ${a.lesson.discName} (${a.profId})`;
          row.push(`<td>${escapeHtml(text)}</td>`);
        } else {
          row.push(`<td style="color:#6b7a8c">—</td>`);
        }
      }
      tableRows.push(`<tr>${row.join('')}</tr>`);
    }
    // header days
    const header = `<tr><th></th>${DAYS.map(d=>`<th>${d}</th>`).join('')}</tr>`;
    scheduleArea.innerHTML = `<div class="room-grid"><h4>${escapeHtml(ROOMS[roomIndex])}</h4><table>${header}${tableRows.join('')}</table></div>`;
  }

  function escapeHtml(s){ return String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

  // Export CSV: flatten schedule to rows
  function exportCSV(){
    const rows = [['Course','Discipline','Professor','Day','Period','Room']];
    for(const sk in schedule){
      const a = schedule[sk];
      rows.push([a.lesson.courseName, a.lesson.discName, a.profId, DAYS[a.slot.day], a.slot.period+1, ROOMS[a.slot.room]]);
    }
    const csv = rows.map(r => r.map(cell => `"${String(cell).replace(/"/g,'""')}"`).join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a'); a.href = url; a.download = 'horario.csv'; a.click();
    URL.revokeObjectURL(url);
  }

  // Print view: open new window with table
  function printView(){
    const rows = [];
    rows.push('<tr><th>Course</th><th>Disciplina</th><th>Professor</th><th>Dia</th><th>Tempo</th><th>Sala</th></tr>');
    for(const sk in schedule){
      const a = schedule[sk];
      rows.push(`<tr><td>${escapeHtml(a.lesson.courseName)}</td><td>${escapeHtml(a.lesson.discName)}</td><td>${escapeHtml(a.profId)}</td><td>${escapeHtml(DAYS[a.slot.day])}</td><td>${a.slot.period+1}</td><td>${escapeHtml(ROOMS[a.slot.room])}</td></tr>`);
    }
    const html = `<html><head><title>Horário</title><style>body{font-family:Segoe UI,sans-serif;padding:20px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ddd;padding:8px;text-align:left}th{background:#27ae60;color:#fff}</style></head><body><h2>Horário - Export</h2><table>${rows.join('')}</table></body></html>`;
    const w = window.open('','_blank');
    w.document.write(html);
    w.document.close();
    w.focus();
    // user can print -> save as PDF
  }

  // UI events
  document.getElementById('btnGenerate').addEventListener('click', async ()=>{
    // rebuild lessons (in case user altered data)
    lessons = buildLessonsFromCourses(COURSES);
    // quick feedback
    document.getElementById('btnGenerate').textContent = 'Gerando...';
    await new Promise(r=>setTimeout(r,50));
    const res = solveSchedule(12000); // 12s timeout
    document.getElementById('btnGenerate').innerHTML = '<i class="fas fa-cogs"></i> Gerar Horário';
    if(res.timeout){
      alert('Tempo esgotado: não conseguiu concluir em 12s. Pode tentar novamente ou ajustar dados.');
    }
    if(!res.ok){
      alert('Não foi possível gerar horário completo. Resultado parcial pode ter sido criado. ' + (res.message||''));
    } else {
      alert('Horário gerado com sucesso!');
    }
    // render default view
    renderAll(viewMode.value, Number(selectRoom.value), searchInput.value);
  });

  document.getElementById('btnExportCSV').addEventListener('click', exportCSV);
  document.getElementById('btnPrint').addEventListener('click', printView);

  selectRoom.addEventListener('change', ()=> renderAll(viewMode.value, Number(selectRoom.value), searchInput.value));
  viewMode.addEventListener('change', ()=> renderAll(viewMode.value, Number(selectRoom.value), searchInput.value));
  searchInput.addEventListener('input', ()=> renderAll(viewMode.value, Number(selectRoom.value), searchInput.value));
  document.getElementById('globalSearch').addEventListener('input', (e)=> renderAll(viewMode.value, Number(selectRoom.value), e.target.value));

  // initial
  updateSummary();
  // prefill schedule empty
  schedule = {};
  renderAll(viewMode.value, 0, '');
})();
</script>


<?php
require_once "../../../assets/_includes/menu.php";
?>
