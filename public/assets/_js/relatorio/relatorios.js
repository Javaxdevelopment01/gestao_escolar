// ================= Dados simulados
const relatorios = [
  { id: 1, nome: "Leonel Amaralo", funcao: "Aluno", data: "2025-08-01", detalhes: "Nota média: 18" },
  { id: 2, nome: "Domingos Silva", funcao: "Aluno", data: "2025-08-02", detalhes: "Nota média: 17" },
  { id: 3, nome: "Gabriel Costa", funcao: "Professor", data: "2025-08-03", detalhes: "Desempenho: Excelente" },
  { id: 4, nome: "Ernesto Lima", funcao: "Diretor", data: "2025-08-04", detalhes: "Gestão eficiente" },
  { id: 5, nome: "Ana Paula", funcao: "Funcionário", data: "2025-08-05", detalhes: "Segurança" },
  { id: 6, nome: "Maria Clara", funcao: "Funcionário", data: "2025-08-06", detalhes: "Limpeza" },
  { id: 7, nome: "João Pedro", funcao: "Aluno", data: "2025-08-07", detalhes: "Nota média: 16" },
  { id: 8, nome: "Rita Santos", funcao: "Professor", data: "2025-08-08", detalhes: "Desempenho: Muito Bom" },
  { id: 9, nome: "Carlos Lima", funcao: "Diretor", data: "2025-08-09", detalhes: "Gestão satisfatória" },
  { id: 10, nome: "Pedro Sousa", funcao: "Funcionário", data: "2025-08-10", detalhes: "Segurança" },
];

// ================= Carregar dados na tabela
const tbody = document.querySelector("#relatorioTable tbody");

function carregarTabela(data) {
  tbody.innerHTML = "";
  data.forEach((item, index) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${index+1}</td>
      <td>${item.nome}</td>
      <td>${item.funcao}</td>
      <td>${item.data}</td>
      <td>${item.detalhes}</td>
    `;
    tbody.appendChild(tr);
  });
}

carregarTabela(relatorios);

// ================= Filtrar Relatórios
document.getElementById("gerarRelatorio").addEventListener("click", () => {
  const tipo = document.getElementById("selectTipoRelatorio").value;
  const inicio = document.getElementById("dataInicio").value;
  const fim = document.getElementById("dataFim").value;

  let filtrado = relatorios;

  if(tipo) filtrado = filtrado.filter(r => r.funcao === tipo);
  if(inicio) filtrado = filtrado.filter(r => r.data >= inicio);
  if(fim) filtrado = filtrado.filter(r => r.data <= fim);

  carregarTabela(filtrado);
});

// ================= Exportar PDF
document.getElementById("exportPDF").addEventListener("click", () => {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();
  doc.text("Relatório Gestão Escolar", 14, 20);
  doc.autoTable({ html: "#relatorioTable", startY: 30 });
  doc.save("relatorio.pdf");
});

// ================= Exportar Excel
document.getElementById("exportXLS").addEventListener("click", () => {
  const table = document.getElementById("relatorioTable");
  const wb = XLSX.utils.table_to_book(table, { sheet: "Relatórios" });
  XLSX.writeFile(wb, "relatorio.xlsx");
});
