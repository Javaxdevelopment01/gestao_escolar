<?php
require_once "../../../assets/_includes/header.php";
?>

  <title>Painel - Gestão Escolar</title>
  <link rel="stylesheet" href="../../../assets/_css/dashboard/dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
require_once "../../../assets/_includes/menu.php";
?>
  <!-- Sidebar
  <aside class="sidebar">
    <div class="sidebar-logo">
      <img src="../SGE/public/assets/_images/logo_ipm2.png" alt="Logo">
      <h2>Gestão Escolar</h2>
     
    </div>

    <nav class="sidebar-nav">
      <a href="dashboard.html" class="active"><i class="fas fa-chart-line"></i> Dashboard</a>

      <h3 class="menu-title">Gestão Acadêmica</h3>
      <a href="alunos.html"><i class="fas fa-user-graduate"></i> Alunos</a>
      <a href="professores.html"><i class="fas fa-user-tie"></i> Professores</a>
      <a href="turmas.html"><i class="fas fa-users"></i> Turmas</a>
      <a href="disciplinas.html"><i class="fas fa-book"></i> Disciplinas</a>
      <a href="horarios.html"><i class="fas fa-calendar-alt"></i> Horários</a>

      <h3 class="menu-title">Notas & Avaliações</h3>
      <a href="lancar_notas.html"><i class="fas fa-clipboard-check"></i> Lançar Notas</a>
      <a href="ver_pauta.html"><i class="fas fa-eye"></i> Ver Pauta</a>
      <a href="boletins.html"><i class="fas fa-certificate"></i> Boletins</a>

      <h3 class="menu-title">Infraestrutura & Pessoal</h3>
      <a href="salas_blocos.html"><i class="fas fa-building"></i> Salas & Blocos</a>
      <a href="funcionarios.html"><i class="fas fa-user-cog"></i> Funcionários</a>

      <h3 class="menu-title">Desempenho & Relatórios</h3>
      <a href="desempenho.html"><i class="fas fa-chart-bar"></i> Desempenho</a>
      <a href="relatorios.html"><i class="fas fa-chart-pie"></i> Relatórios</a>

      <h3 class="menu-title">Gestão Financeira</h3>
      <a href="financas.html"><i class="fas fa-money-bill-wave"></i> Finanças</a>
      <a href="recursos_humanos.html"><i class="fas fa-users-cog"></i> Recursos Humanos</a>

      <h3 class="menu-title">Sistema</h3>
      <a href="mensagens.html"><i class="fas fa-envelope-open-text"></i> Mensagens</a>
      <a href="definicoes.html"><i class="fas fa-cog"></i> Definições</a>
      <a href="login.html"><i class="fas fa-sign-out-alt"></i> Terminar Sessão</a>
    </nav>
  </aside>
 -->
  <!-- Main -->
  <main class="main-content">
     

    <section class="content">
  <h1>Bem-vindo ao Sistema de Gestão Escolar 🎓</h1>
  <div class="cards-container">
    <div class="card">
      <i class="fas fa-user-graduate"></i>
      <div class="card-info">
        <h2>245</h2>
        <p>Alunos</p>
      </div>
    </div>
    <div class="card">
      <i class="fas fa-user-tie"></i>
      <div class="card-info">
        <h2>35</h2>
        <p>Professores</p>
      </div>
    </div>
    <div class="card">
      <i class="fas fa-building"></i>
      <div class="card-info">
        <h2>12</h2>
        <p>Salas</p>
      </div>
    </div>
    <div class="card">
      <i class="fas fa-book"></i>
      <div class="card-info">
        <h2>18</h2>
        <p>Disciplinas</p>
      </div>
    </div>
  </div>

  <div class="charts-container">
    <div class="chart-box">
      <h3>Finanças da Escola</h3>
      <canvas id="financeChart"></canvas>
    </div>
    <div class="chart-box">
      <h3>Desempenho Acadêmico</h3>
      <canvas id="performanceChart"></canvas>
    </div>
  </div>
</section>

  </main>

  <script src="../../../assets/_js/dashboard/dashboard.js"></script>


<?php
require_once "../../../assets/_includes/footer.php";
?>